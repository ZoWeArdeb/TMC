<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'game';

    protected $guarded = [];

    protected $dates = array(
        'play_at',
    );

    public function home()
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function away()
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    public function getScoreAttribute()
    {
        return (is_null($this->score_home) ? '?' : $this->score_home) . '-' .
            (is_null($this->score_away) ? '?' : $this->score_away);
    }
}
