<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = 'team';

    protected $fillable = array('name','league_id');

    public function homeGames()
    {
        return $this->hasMany(Game::class, 'home_team_id')->with('home', 'away');
    }

    public function awayGames()
    {
        return $this->hasMany(Game::class, 'away_team_id')->with('home', 'away');
    }

    public function getGamesAttribute() {
        return $this->homeGames->merge($this->awayGames);
    }
}