<?php
namespace App\Http\Controllers;
use App\Models\ClothingOrder;
use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClothingOrderController extends Controller {
    public function index(Request $request){
        $q=$request->string('q')->toString(); $status=$request->string('status')->toString();
        $orders=ClothingOrder::with(['customer','employee'])->when($q,fn($x)=>$x->where(fn($w)=>$w->where('order_code','like',"%$q%")->orWhere('garment_type','like',"%$q%")->orWhereHas('customer',fn($c)=>$c->where('name','like',"%$q%"))))->when($status,fn($x)=>$x->where('status',$status))->latest()->paginate(10)->withQueryString();
        return view('orders.index',compact('orders','q','status'));
    }
    public function create(){ return view('orders.create',['customers'=>Customer::orderBy('name')->get(),'employees'=>Employee::where('status','Active')->orderBy('name')->get()]); }
    public function store(Request $request){
        $data=$request->validate(['order_code'=>'nullable|string|max:30|unique:clothing_orders,order_code','customer_id'=>'required|exists:customers,id','employee_id'=>'nullable|exists:employees,id','garment_type'=>'required|string|max:100','fabric'=>'nullable|string|max:100','color'=>'nullable|string|max:60','size'=>'nullable|string|max:30','order_date'=>'required|date','due_date'=>'nullable|date|after_or_equal:order_date','total_amount'=>'required|numeric|min:0','status'=>'required|in:Pending,In Progress,Ready,Completed,Cancelled','special_instructions'=>'nullable|string|max:1500']);
        $data['order_code']=$data['order_code'] ?: 'ORD-'.str_pad((string)(ClothingOrder::max('id')+1),5,'0',STR_PAD_LEFT);
        ClothingOrder::create($data); return redirect()->route('orders.index')->with('success','Clothing order created successfully.');
    }
    public function show(ClothingOrder $order){ $order->load(['customer','employee','measurements','payments'=>fn($q)=>$q->latest()]); return view('orders.show',compact('order')); }
    public function edit(ClothingOrder $order){ return view('orders.edit',['order'=>$order,'customers'=>Customer::orderBy('name')->get(),'employees'=>Employee::where('status','Active')->orderBy('name')->get()]); }
    public function update(Request $request,ClothingOrder $order){
        $data=$request->validate(['order_code'=>['required','string','max:30',Rule::unique('clothing_orders')->ignore($order->id)],'customer_id'=>'required|exists:customers,id','employee_id'=>'nullable|exists:employees,id','garment_type'=>'required|string|max:100','fabric'=>'nullable|string|max:100','color'=>'nullable|string|max:60','size'=>'nullable|string|max:30','order_date'=>'required|date','due_date'=>'nullable|date|after_or_equal:order_date','total_amount'=>'required|numeric|min:0','status'=>'required|in:Pending,In Progress,Ready,Completed,Cancelled','special_instructions'=>'nullable|string|max:1500']);
        $order->update($data); return redirect()->route('orders.show',$order)->with('success','Order updated successfully.');
    }
    public function destroy(ClothingOrder $order){ $order->delete(); return redirect()->route('orders.index')->with('success','Order deleted successfully.'); }
}
