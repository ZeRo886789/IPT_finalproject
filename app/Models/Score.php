<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $primaryKey = 'score_id';

    public $timestamps = false;

    protected $fillable = [
        'game_id',
        'team_id',
        'points',
        'quarter',
        'score_type',
        'score_time',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id', 'game_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'team_id');
    }
}
