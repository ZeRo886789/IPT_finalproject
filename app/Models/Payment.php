<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Payment extends Model {
    use HasFactory;
    protected $fillable = ['clothing_order_id','payment_date','amount','payment_method','reference_no','status','notes'];
    protected $casts = ['payment_date'=>'date','amount'=>'decimal:2'];
    public function order(){ return $this->belongsTo(ClothingOrder::class,'clothing_order_id'); }
}
