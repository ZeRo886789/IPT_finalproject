<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Measurement extends Model {
    use HasFactory;
    protected $fillable = ['customer_id','clothing_order_id','chest','waist','hip','shoulder','sleeve','neck','length','unit','notes'];
    public function customer(){ return $this->belongsTo(Customer::class); }
    public function order(){ return $this->belongsTo(ClothingOrder::class,'clothing_order_id'); }
}
