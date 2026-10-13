<?php

namespace App\Http\Controllers;

use App\Models\ClothingOrder;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Measurement;
use App\Models\Payment;

class DashboardController extends Controller
{
    public function index()
    {
        $counts = [
            'customers' => Customer::count(),
            'employees' => Employee::where('status', 'Active')->count(),
            'orders' => ClothingOrder::count(),
            'measurements' => Measurement::count(),
            'payments' => Payment::where('status', 'Paid')->count(),
        ];

        $orderStats = [
            'pending' => ClothingOrder::where('status', 'Pending')->count(),
            'in_progress' => ClothingOrder::whereIn('status', ['In Progress', 'Ready'])->count(),
            'completed' => ClothingOrder::where('status', 'Completed')->count(),
            'overdue' => ClothingOrder::whereNotIn('status', ['Completed', 'Cancelled'])
                ->whereNotNull('due_date')
                ->whereDate('due_date', '<', now())
                ->count(),
        ];

        $revenue = (float) Payment::where('status', 'Paid')->sum('amount');
        $outstanding = max(0, (float) ClothingOrder::sum('total_amount') - $revenue);

        $recentOrders = ClothingOrder::with('customer')->latest()->take(6)->get();
        $dueSoon = ClothingOrder::with('customer')
            ->whereNotIn('status', ['Completed', 'Cancelled'])
            ->whereNotNull('due_date')
            ->orderBy('due_date')
            ->take(5)
            ->get();

        return view('dashboard', compact('counts', 'orderStats', 'revenue', 'outstanding', 'recentOrders', 'dueSoon'));
    }
}
