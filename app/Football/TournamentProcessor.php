<?php

namespace App\Football;

use App\Models\Game;
use App\Models\League;
use App\Models\Ranking;
use App\Models\Team;
use App\Models\Tournament;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class TournamentProcessor
{
    /** @var Tournament */
    private $tournament = null;

    public function generate(Tournament $tournament) {
        $this->tournament = $tournament;

        $teamTotal = $this->getSettings()->get('teams');
        $leagueTotal = $this->getSettings()->get('groups');

        $this->generateTeams($teamTotal);
        $this->generateLeagues($leagueTotal);
        $this->generateRanking($teamTotal, $leagueTotal);
        $this->generateGames();
    }

    private function generateTeams($teamTotal) {
        if ($this->tournament->teams->count() < $teamTotal) {
            $teamsLeft = $teamTotal - $this->tournament->teams->count();
            for($i = 1; $i <= $teamsLeft; $i++) {
                $letter = $this->getLetterCode($i);
                $this->tournament->teams()->save(new Team(['code' => 'T' . $letter, 'name' => 'Team ' . $letter]));
            }
        }
    }

    private function generateLeagues($leagueTotal) {
        if ($this->tournament->leagues->count() < $leagueTotal) {
            $leaguesLeft = $leagueTotal - $this->tournament->leagues->count();
            for($i = 1; $i <= $leaguesLeft; $i++) {
                $letter = $this->getLetterCode($i);
                $this->tournament->leagues()->save(new League(['code' => 'L' . $letter, 'name' => 'League ' . $letter]));
            }
        }
    }

    private function generateRanking($teamTotal, $leagueTotal) {
        $leagueList = $this->tournament->load('leagues')->leagues->take($leagueTotal);
        $teamList = $this->tournament->load('teams')->teams->take($teamTotal)->split($leagueTotal);

        Ranking::where('tournament_id', $this->tournament->id)->delete();

        $ranking = collect();
        foreach ($leagueList as $id => $league) {
            foreach ($teamList->get($id) as $team) {
                $r = new Ranking();
                $r->league()->associate($league);
                $r->team()->associate($team);
                $ranking->push($r);
            }
        }
        $this->tournament->ranking()->saveMany($ranking);
    }

    private function generateGames() {
        $ranking = $this->tournament->load('ranking')->ranking;
        $ranking = $ranking->groupBy('league_id');

        $games = collect();
        foreach ($ranking as $leagueID => $r) {
            $teams = $r->pluck('team_id');
            $gameToPlay = $teams->count() - 1;

            for ($i = 1; $i <= $gameToPlay; $i++) {
                $chunks = $teams->chunk(2);
                foreach ($chunks as $chunk) {
                    $chunk = $chunk->values();

                    $game = new Game();
                    $game->league_id = $leagueID;
                    $game->home_team_id = $chunk->get(0);
                    $game->away_team_id = $chunk->get(1);
                    $game->start_date = $this->tournament->start_date;
                    $games->push($game);

                }

                // Rotate teams
                $teamID = $teams->pull(1);
                $teams = $teams->push($teamID)->values();
            }
        }
        $this->tournament->games()->saveMany($games);
    }

    private function getLetterCode($number, $upper = true) {
        $letter = null;
        if ($number > 26) {
            $index = intval(floor($number / 26));
            $letter = $this->getLetterCode($index, $upper);

            $number = $number - ($index * 26);
        }
        $letter = $letter . substr('abcdefghijklmnopqrstuvwxyz', $number - 1, 1);
        return ($upper) ? strtoupper($letter) : $letter;
    }

    /**
     * @return Collection
     */
    private function getSettings() {
        return $this->tournament->settings;
    }

}