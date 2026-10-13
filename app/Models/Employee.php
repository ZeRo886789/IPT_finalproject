<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Employee extends Model {
    use HasFactory;
    protected $fillable = ['employee_code','name','role','phone','email','hire_date','status'];
    protected $casts = ['hire_date'=>'date'];
    public function orders(){ return $this->hasMany(ClothingOrder::class); }
}
