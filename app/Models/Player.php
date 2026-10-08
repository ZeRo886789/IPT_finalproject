<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $primaryKey = 'player_id';

    protected $fillable = [
        'team_id',
        'name',
        'jersey_no',
        'position',
        'age',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'team_id');
    }
}
