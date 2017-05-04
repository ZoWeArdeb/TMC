<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Tournament extends Model
{
    protected $table = 'tournament';

    protected $dates = array(
        'start_date',
        'end_date'
    );

    public function teams()
    {
        return $this->hasMany(Team::class, 'tournament_id');
    }

    public function leagues()
    {
        return $this->hasMany(League::class, 'tournament_id');
    }

    public function ranking()
    {
        return $this->hasMany(Ranking::class, 'tournament_id');
    }

    public function games()
    {
        return $this->hasMany(Game::class, 'tournament_id');
    }

    public function knockouts()
    {
        return $this->hasMany(Knockout::class, 'tournament_id');
    }

    /**
     * @param $value
     * @return Collection
     */
    public function getSettingsAttribute($value) {
        return collect(json_decode($value));
    }

    public function setSettingsAttribute($value) {
        $this->attributes['settings'] = json_encode($value);
    }

    public function getRankingByLeague($leagueId) {
        /** @var Collection $ranking */
        $ranking = $this->hasMany(Ranking::class, 'league_id')->where('league_id', '=', $leagueId)->with('team', 'league')->get();

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