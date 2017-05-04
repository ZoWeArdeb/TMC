<?php

namespace App\Http\Controllers\Hulp;

use App\Football\LeagueProcessor;
use App\Football\TournamentProcessor;
use App\Http\Controllers\Controller;
use App\Models\Tournament;

class HulpController extends Controller
{
    public function generateTournament(Tournament $tournament) {
        /** @var TournamentProcessor $tournamentProcessor */
        $tournamentProcessor = app(TournamentProcessor::class);
        $tournamentProcessor->generate($tournament);

        session('message', 'Successfully generated tournament');
        return redirect()->route('tournamentShow', array(
            'tournament' => $tournament
        ));
    }

    public function fillAllScores(Tournament $tournament) {
        $games = $tournament->games;
        $games->transform(function ($game, $key) {
            $game->score_home = rand(0, 8);
            $game->score_away = rand(0, 8);
            return $game;
        });

        $tournament->games()->saveMany($games);

        $this->calculateAllRankings($tournament);

        session('message', 'Successfully filled all scores');
        return redirect()->route('tournamentShow', array(
            'tournament' => $tournament
        ));
    }

    private function calculateAllRankings(Tournament $tournament) {
        /** @var LeagueProcessor $leagueProcessor */
        $leagueProcessor = app(LeagueProcessor::class);

        foreach ($tournament->leagues as $league) {
            $leagueProcessor->calculateRanking($league);
        }
    }
}
