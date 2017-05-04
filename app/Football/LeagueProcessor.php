<?php

namespace App\Football;

use App\Models\League;

class LeagueProcessor
{
    public function calculateRanking(League $league) {
        $games = $league->games()->whereNotNull('score_home')->whereNotNull('score_away')->get();

        $teamRank = collect([]);
        $games->each(function ($game, $key) use ($teamRank) {
            $homeTeam = $teamRank->get($game->home_team_id, collect([]));
            $awayTeam = $teamRank->get($game->away_team_id, collect([]));

            if ($game->score_home > $game->score_away) {
                $homeTeam->put('win', $homeTeam->get('win', 0) + 1);
                $awayTeam->put('loss', $awayTeam->get('loss', 0) + 1);
            } elseif ($game->score_home == $game->score_away) {
                $homeTeam->put('draw', $homeTeam->get('draw', 0) + 1);
                $awayTeam->put('draw', $awayTeam->get('draw', 0) + 1);
            } else {
                $homeTeam->put('loss', $homeTeam->get('loss', 0) + 1);
                $awayTeam->put('win', $awayTeam->get('win', 0) + 1);
            }
            $homeTeam->put('for', $homeTeam->get('for', 0) + $game->score_home);
            $awayTeam->put('for', $awayTeam->get('for', 0) + $game->score_away);
            $homeTeam->put('against', $homeTeam->get('against', 0) + $game->score_away);
            $awayTeam->put('against', $awayTeam->get('against', 0) + $game->score_home);

            $teamRank->put($game->home_team_id, $homeTeam);
            $teamRank->put($game->away_team_id, $awayTeam);
        });

        $league->ranking()->syncWithoutDetaching($teamRank->toArray());
    }
}