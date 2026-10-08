<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $primaryKey = 'game_id';

    protected $fillable = [
        'team_id',
        'game_date',
        'venue',
        'time',
        'game_status',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'team_id');
    }

    public function scores()
    {
        return $this->hasMany(Score::class, 'game_id', 'game_id');
    }
}
