<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Repositories\Contracts\TeamRepositoryInterface;

class TeamController extends Controller
{
    /** @var TeamRepositoryInterface */
    private $teamRepository;

    function __construct(TeamRepositoryInterface $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    public function index()
    {
        $teams = $this->teamRepository->getAll();
        return view('team.index', compact('teams'));
    }

    public function create()
    {
        return view('team.create');
    }

    public function store()
    {
        $rules = collect([
            'code' => 'required',
            'name' => 'required'
        ]);

        $validator = validator(request()->all(), $rules->toArray());
        if ($validator->fails()) {
            return redirect()->route('teamCreate')->withErrors($validator)->withInput(request()->except('password'));
        }

        $item = new Team(array(
            'name' => request('name'),
            'code' => request('code')
        ));
        $item->save();

        session('message', 'Successfully created team');
        return redirect()->route('teams');
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
            'code' => 'required',
            'name' => 'required'
        ]);

        $validator = validator(request()->all(), $rules->toArray());
        if ($validator->fails()) {
            return redirect()->route('teamEdit', array('team' => $team))->withErrors($validator)->withInput(request()->except('password'));
        }

        $team->name = request('name');
        $team->code = request('code');
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
