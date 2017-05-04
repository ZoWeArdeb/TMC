<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    protected $table = 'ranking';

    protected $fillable = array('league_id', 'team_id');

    public $timestamps = false;

    public function tournament()
    {
        return $this->belongsTo(Tournament::class, 'tournament_id');
    }

    public function league()
    {
        return $this->belongsTo(League::class, 'league_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }



}