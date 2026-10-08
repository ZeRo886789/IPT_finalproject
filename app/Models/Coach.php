<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    use HasFactory;

    protected $primaryKey = 'coach_id';

    protected $fillable = [
        'coach_name',
        'contact_no',
        'experience_year',
        'specialization',
    ];

    public function team()
    {
        return $this->hasOne(Team::class, 'coach_id', 'coach_id');
    }
}
