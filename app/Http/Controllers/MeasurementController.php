<?php
namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\ClothingOrder;
use App\Models\Measurement;
use Illuminate\Http\Request;

class MeasurementController extends Controller {
    public function index(Request $request){
        $q=$request->string('q')->toString();
        $measurements=Measurement::with(['customer','order'])->when($q,fn($x)=>$x->whereHas('customer',fn($c)=>$c->where('name','like',"%$q%")))->latest()->paginate(10)->withQueryString();
        return view('measurements.index',compact('measurements','q'));
    }
    public function create(){ return view('measurements.create',['customers'=>Customer::orderBy('name')->get(),'orders'=>ClothingOrder::with('customer')->latest()->get()]); }
    public function store(Request $request){ $data=$this->validateData($request); Measurement::create($data); return redirect()->route('measurements.index')->with('success','Measurement record saved.'); }
    public function show(Measurement $measurement){ $measurement->load(['customer','order']); return view('measurements.show',compact('measurement')); }
    public function edit(Measurement $measurement){ return view('measurements.edit',['measurement'=>$measurement,'customers'=>Customer::orderBy('name')->get(),'orders'=>ClothingOrder::with('customer')->latest()->get()]); }
    public function update(Request $request,Measurement $measurement){ $measurement->update($this->validateData($request)); return redirect()->route('measurements.show',$measurement)->with('success','Measurement updated successfully.'); }
    public function destroy(Measurement $measurement){ $measurement->delete(); return redirect()->route('measurements.index')->with('success','Measurement deleted successfully.'); }
    private function validateData(Request $request){ return $request->validate(['customer_id'=>'required|exists:customers,id','clothing_order_id'=>'nullable|exists:clothing_orders,id','chest'=>'nullable|numeric|min:0','waist'=>'nullable|numeric|min:0','hip'=>'nullable|numeric|min:0','shoulder'=>'nullable|numeric|min:0','sleeve'=>'nullable|numeric|min:0','neck'=>'nullable|numeric|min:0','length'=>'nullable|numeric|min:0','unit'=>'required|in:in,cm','notes'=>'nullable|string|max:1000']); }
}
