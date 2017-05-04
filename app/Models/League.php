<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class League extends Model
{
    protected $table = 'league';

    protected $fillable = array('name', 'code');

    public function tournament()
    {
        return $this->belongsTo(Tournament::class, 'tournament_id');
    }

    public function games()
    {
        return $this->hasMany(Game::class, 'league_id')->with('home', 'away');
    }

    public function ranking()
    {
        return $this->belongsToMany(Team::class, 'ranking');
    }

    public function getRanking() {
        /** @var Collection $ranking */
        $ranking = $this->hasMany(Ranking::class, 'league_id')->with('team', 'league')->get();

        $ranking = $ranking->transform(function ($item, $key) {
            return collect([
                'league' => collect([
                    'id' => $item->league_id,
                    'name' => $item->league->name
                ]),
                'team' => collect([
                    'id' => $item->team_id,
                    'name' => $item->team->name
                ]),
                'win' => $item->win,
                'draw' => $item->draw,
                'loss' => $item->loss,
                'for' => $item->for,
                'against' => $item->against,
                'played' => $item->win + $item->draw + $item->loss,
                'points' => ($item->win * 3) + $item->draw,
                'diff' => $item->for - $item->against
            ]);
        })->sortByDesc(function ($rank, $key) {
            return $rank->get('diff') + $rank->get('for');
        })->sortByDesc('points')->values();

        return $ranking;
    }

}