<?php
namespace App\Http\Controllers;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller {
    public function index(Request $request){
        $q=$request->string('q')->toString();
        $employees=Employee::withCount('orders')->when($q,fn($x)=>$x->where(fn($w)=>$w->where('name','like',"%$q%")->orWhere('employee_code','like',"%$q%")->orWhere('role','like',"%$q%")))->latest()->paginate(10)->withQueryString();
        return view('employees.index',compact('employees','q'));
    }
    public function create(){ return view('employees.create'); }
    public function store(Request $request){
        $data=$request->validate(['employee_code'=>'nullable|string|max:30|unique:employees,employee_code','name'=>'required|string|max:120','role'=>'required|string|max:80','phone'=>'required|string|max:30','email'=>'nullable|email|max:120','hire_date'=>'nullable|date','status'=>'required|in:Active,Inactive']);
         $data['employee_code']=($data['employee_code'] ?? null) ?: 'EMP-'.str_pad((string)(Employee::max('id')+1),4,'0',STR_PAD_LEFT);
        Employee::create($data); return redirect()->route('employees.index')->with('success','Employee added successfully.');
    }
    public function show(Employee $employee){ $employee->load('orders.customer'); return view('employees.show',compact('employee')); }
    public function edit(Employee $employee){ return view('employees.edit',compact('employee')); }
    public function update(Request $request,Employee $employee){
        $data=$request->validate(['employee_code'=>['required','string','max:30',Rule::unique('employees')->ignore($employee->id)],'name'=>'required|string|max:120','role'=>'required|string|max:80','phone'=>'required|string|max:30','email'=>'nullable|email|max:120','hire_date'=>'nullable|date','status'=>'required|in:Active,Inactive']);
        $employee->update($data); return redirect()->route('employees.index')->with('success','Employee updated successfully.');
    }
    public function destroy(Employee $employee){ $employee->delete(); return back()->with('success','Employee deleted successfully.'); }
}
