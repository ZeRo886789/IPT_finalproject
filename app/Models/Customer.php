<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Customer extends Model {
    use HasFactory;
    protected $fillable = ['customer_code','name','phone','email','address','notes'];
    public function orders(){ return $this->hasMany(ClothingOrder::class); }
    public function measurements(){ return $this->hasMany(Measurement::class); }
    public function getOutstandingAttribute(){
        $total=$this->orders()->sum('total_amount');
        $paid=$this->orders()->withSum(['payments as paid_amount'=>fn($q)=>$q->where('status','Paid')],'amount')->get()->sum('paid_amount');
        return max(0,$total-$paid);
    }
}
