<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $primaryKey = 'team_id';

    protected $fillable = [
        'coach_id',
        'team_name',
        'city',
        'tel_no',
        'founded_year',
    ];

    public function coach()
    {
        return $this->belongsTo(Coach::class, 'coach_id', 'coach_id');
    }

    public function players()
    {
        return $this->hasMany(Player::class, 'team_id', 'team_id');
    }

    public function games()
    {
        return $this->hasMany(Game::class, 'team_id', 'team_id');
    }

    public function scores()
    {
        return $this->hasMany(Score::class, 'team_id', 'team_id');
    }
}
