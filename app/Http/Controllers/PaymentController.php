<?php

namespace App\Http\Controllers;

use App\Models\ClothingOrder;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->string('q')->toString();
        $payments = Payment::with('order.customer')
            ->when($q, fn ($x) => $x->where('reference_no', 'like', "%$q%")->orWhereHas('order', fn ($o) => $o->where('order_code', 'like', "%$q%")->orWhereHas('customer', fn ($c) => $c->where('name', 'like', "%$q%"))))
            ->latest('payment_date')
            ->paginate(10)
            ->withQueryString();
        return view('payments.index', compact('payments', 'q'));
    }

    public function create()
    {
        return view('payments.create', [
            'orders' => ClothingOrder::with('customer')->whereIn('status', ['Pending', 'In Progress', 'Ready', 'Completed'])->latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        DB::transaction(function () use ($data) {
            $order = ClothingOrder::with('payments')->findOrFail($data['clothing_order_id']);
            $paid = (float) $order->payments->where('status', 'Paid')->sum('amount');
            $balance = max(0.0, (float) $order->total_amount - $paid);

            if ($data['status'] === 'Paid' && (float) $data['amount'] > $balance) {
                throw ValidationException::withMessages([
                    'amount' => 'This payment (₱' . number_format((float) $data['amount'], 2)
                        . ') exceeds the outstanding balance of ₱' . number_format($balance, 2)
                        . ' for order ' . $order->order_code . '.',
                ]);
            }

            Payment::create($data);
        });

        return redirect()->route('payments.index')->with('success', 'Payment recorded successfully.');
    }

    public function show(Payment $payment)
    {
        $payment->load('order.customer');
        return view('payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        return view('payments.edit', [
            'payment' => $payment,
            'orders' => ClothingOrder::with('customer')->latest()->get(),
        ]);
    }

    public function update(Request $request, Payment $payment)
    {
        $data = $this->validateData($request);

        DB::transaction(function () use ($data, $payment) {
            $order = ClothingOrder::with('payments')->findOrFail($data['clothing_order_id']);
            $paid = (float) $order->payments->where('status', 'Paid')->where('id', '!=', $payment->id)->sum('amount');
            $balance = max(0.0, (float) $order->total_amount - $paid);

            if ($data['status'] === 'Paid' && (float) $data['amount'] > $balance) {
                throw ValidationException::withMessages([
                    'amount' => 'This payment (₱' . number_format((float) $data['amount'], 2)
                        . ') exceeds the outstanding balance of ₱' . number_format($balance, 2)
                        . ' for order ' . $order->order_code . '.',
                ]);
            }

            $payment->update($data);
        });

        return redirect()->route('payments.show', $payment)->with('success', 'Payment updated successfully.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'Payment deleted successfully.');
    }

    private function validateData(Request $request)
    {
        return $request->validate([
            'clothing_order_id' => 'required|exists:clothing_orders,id',
            'payment_date' => 'required|date',
            'amount' => 'required|numeric|min:0.01',
            'payment_method' => 'required|in:Cash,GCash,Bank Transfer,Card',
            'reference_no' => 'nullable|string|max:80',
            'status' => 'required|in:Paid,Pending,Refunded',
            'notes' => 'nullable|string|max:1000',
        ]);
    }
}
