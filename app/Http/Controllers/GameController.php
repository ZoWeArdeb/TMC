<?php

namespace App\Http\Controllers;

use App\Football\LeagueProcessor;
use App\Models\Game;
use App\Models\Tournament;
use App\Repositories\Contracts\GameRepositoryInterface;
use App\Repositories\Contracts\TeamRepositoryInterface;
use Carbon\Carbon;

class GameController extends Controller
{
    /** @var GameRepositoryInterface */
    private $gameRepository;

    /** @var TeamRepositoryInterface */
    private $teamRepository;

    function __construct(GameRepositoryInterface $gameRepository, TeamRepositoryInterface $teamRepository)
    {
        $this->gameRepository = $gameRepository;
        $this->teamRepository = $teamRepository;
    }

    public function index()
    {
        $games = $this->gameRepository->getAll();
        return view('game.index', compact('games'));
    }

    public function create()
    {
        $teams = $this->teamRepository->getAll();
        return view('game.create', compact('teams'));
    }

    public function store()
    {
        /*$rules = collect([
            'code' => 'required',
            'name' => 'required'
        ]);

        $validator = validator(request()->all(), $rules->toArray());
        if ($validator->fails()) {
            return redirect()->route('gameCreate')->withErrors($validator)->withInput(request()->except('password'));
        }*/

        $data = collect(request()->all());
        $data = $data->filter(function ($value, $key) {
            return ! empty($value);
        })->except(['_token']);

        $item = new Game([
            'key' => '12345678',
            'home_team_id' => $data->get('home_team'),
            'away_team_id' => $data->get('away_team'),
            'score_home' => $data->get('score_home'),
            'score_away' => $data->get('score_away'),
            'score_home_et' => $data->get('score_home_et'),
            'score_away_et' => $data->get('score_away_et'),
            'score_home_p' => $data->get('score_home_p'),
            'score_away_p' => $data->get('score_away_p'),
            'play_at' => $data->get('play_at', Carbon::now()),
            'postponed' => $data->get('postponed', false)
        ]);
        $item->save();

        session('message', 'Successfully created game');
        return redirect()->route('games');
    }

    public function show(Game $game)
    {
        dd($game);
        return view('game.show', compact('game'));
    }

    public function edit(Game $game)
    {
        return view('game.edit', compact('game'));
    }

    public function update(Game $game)
    {
        $rules = collect([
            'code' => 'required',
            'name' => 'required'
        ]);

        $validator = validator(request()->all(), $rules->toArray());
        if ($validator->fails()) {
            return redirect()->route('gameEdit', array('game' => $game))->withErrors($validator)->withInput(request()->except('password'));
        }

        $game->name = request('name');
        $game->code = request('code');
        $game->save();

        session('message', 'Successfully updated game');
        return redirect()->route('games');
    }

    public function destroy(Game $game)
    {
        $game->delete();

        session('message', 'Successfully deleted game');
        return redirect()->route('games');
    }

    public function scoreEdit(Tournament $tournament, Game $game)
    {
        return view('game.score', compact('tournament', 'game'));
    }

    public function scoreUpdate(Tournament $tournament, Game $game)
    {
        $game->score_home = request()->get('scoreHome');
        $game->score_away = request()->get('scoreAway');
        $game->save();

        /** @var LeagueProcessor $leagueProcessor */
        $leagueProcessor = app(LeagueProcessor::class);
        $leagueProcessor->calculateRanking($game->load('league')->league);

        session('message', 'Successfully updated game');
        return redirect()->route('games', array('tournament' => $tournament));
    }
}
