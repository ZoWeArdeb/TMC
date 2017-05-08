<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Tournament;
use App\Repositories\Contracts\TeamRepositoryInterface;

class TeamController extends Controller
{
    /** @var TeamRepositoryInterface */
    private $teamRepository;

    function __construct(TeamRepositoryInterface $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    public function index(Tournament $tournament)
    {        
        $linkBack = route('tournamentShow', array(
            'tournament' => $tournament
        ));
        $teams = $this->teamRepository->getAll();
        return view('team.index', compact('teams', 'tournament', 'linkBack'));
    }

    public function create(Tournament $tournament)
    {
        $linkBack = route('teams', array(
            'tournament' => $tournament
        ));
        return view('team.create', compact('tournament', 'linkBack'));
    }

    public function store(Tournament $tournament)
    {
        $rules = collect([
            'league' => 'required',
            'name' => 'required'
        ]);
        $validator = validator(request()->all(), $rules->toArray());
        if ($validator->fails()) {
            return redirect()->route('teamCreate', array('tournament' => $tournament))->withErrors($validator)->withInput(request()->except('password'));
        }

        $item = new Team(array(
            'name' => request('name'),
            'league_id' => request('league')
        ));

        $item->save();
        session('message', 'Successfully created team');
        return redirect()->route('teams',array('tournament' => $tournament));
    }

    public function show(Team $team)
    {
        return view('team.show', compact('team'));
    }

    public function edit(Team $team)
    {
        return view('team.edit', compact('team'));
    }

    public function update(Team $team)
    {
        $rules = collect([
            'league' => 'required',
            'name' => 'required'
        ]);

        $validator = validator(request()->all(), $rules->toArray());
        if ($validator->fails()) {
            return redirect()->route('teamEdit', array('team' => $team))->withErrors($validator)->withInput(request()->except('password'));
        }

        $team->name = request('name');
        $team->code = request('league');
        $team->save();

        session('message', 'Successfully updated team');
        return redirect()->route('teams');
    }

    public function destroy(Team $team)
    {
        $team->delete();

        session('message', 'Successfully deleted team');
        return redirect()->route('teams');
    }
}
