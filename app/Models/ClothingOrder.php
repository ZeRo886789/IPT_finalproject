<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class ClothingOrder extends Model {
    use HasFactory;
    protected $table='clothing_orders';
    protected $fillable = ['order_code','customer_id','employee_id','garment_type','fabric','color','size','order_date','due_date','total_amount','status','special_instructions'];
    protected $casts = ['order_date'=>'date','due_date'=>'date','total_amount'=>'decimal:2'];
    public function customer(){ return $this->belongsTo(Customer::class); }
    public function employee(){ return $this->belongsTo(Employee::class); }
    public function measurements(){ return $this->hasMany(Measurement::class); }
    public function payments(){ return $this->hasMany(Payment::class); }
    public function getPaidAmountAttribute(){ return $this->payments->where('status','Paid')->sum('amount'); }
    public function getBalanceAttribute(){ return max(0,(float)$this->total_amount-(float)$this->paid_amount); }
    public function getIsOverdueAttribute(){ return $this->due_date && $this->due_date->isPast() && !in_array($this->status,['Completed','Cancelled']); }
    public function getStatusBadgeAttribute(){ return 'status-'.\Illuminate\Support\Str::slug($this->status); }
}
