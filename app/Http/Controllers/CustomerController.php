<?php
namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerController extends Controller {
    public function index(Request $request) {
        $q=$request->string('q')->toString();
        $customers=Customer::withCount('orders')->when($q,fn($x)=>$x->where(fn($w)=>$w->where('name','like',"%$q%")->orWhere('customer_code','like',"%$q%")->orWhere('phone','like',"%$q%")))->latest()->paginate(10)->withQueryString();
        return view('customers.index',compact('customers','q'));
    }
    public function create(){ return view('customers.create'); }
    public function store(Request $request){
        $data=$request->validate(['customer_code'=>'nullable|string|max:30|unique:customers,customer_code','name'=>'required|string|max:120','phone'=>'required|string|max:30','email'=>'nullable|email|max:120','address'=>'nullable|string|max:500','notes'=>'nullable|string|max:1000']);
        $data['customer_code']=$data['customer_code'] ?: 'CUS-'.str_pad((string)(Customer::max('id')+1),4,'0',STR_PAD_LEFT);
        Customer::create($data);
        return redirect()->route('customers.index')->with('success','Customer added successfully.');
    }
    public function show(Customer $customer){ $customer->load(['orders.employee','measurements']); return view('customers.show',compact('customer')); }
    public function edit(Customer $customer){ return view('customers.edit',compact('customer')); }
    public function update(Request $request,Customer $customer){
        $data=$request->validate(['customer_code'=>['required','string','max:30',Rule::unique('customers')->ignore($customer->id)],'name'=>'required|string|max:120','phone'=>'required|string|max:30','email'=>'nullable|email|max:120','address'=>'nullable|string|max:500','notes'=>'nullable|string|max:1000']);
        $customer->update($data); return redirect()->route('customers.index')->with('success','Customer updated successfully.');
    }
    public function destroy(Customer $customer){ $customer->delete(); return back()->with('success','Customer deleted successfully.'); }
}
