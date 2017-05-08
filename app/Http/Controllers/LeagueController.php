<?php

namespace App\Http\Controllers;

use App\Models\League;
use App\Models\Tournament;

class LeagueController extends Controller
{
    public function index(Tournament $tournament)
    {
        $linkBack = route('tournamentShow', array(
            'tournament' => $tournament
        ));

        return view('league.index', compact('tournament', 'linkBack'));
    }

    public function create(Tournament $tournament)
    {
        $linkBack = route('leagues', array(
            'tournament' => $tournament
        ));
        return view('league.create', compact('tournament', 'linkBack'));
    }

    public function store(Tournament $tournament)
    {
        $rules = collect([
            'name' => 'required'
        ]);

        $validator = validator(request()->all(), $rules->toArray());
        if ($validator->fails()) {
            return redirect()->route('leagueCreate', array('tournament' => $tournament))->withErrors($validator)->withInput(request()->except('password'));
        }

        $item = new League();
        $item->name = request('name');
        $item->tournament_id = $tournament->id;
        $item->save();

        session('message', 'Successfully created league');
        return redirect()->route('leagues', array('tournament' => $tournament));
    }

    public function show(Tournament $tournament, League $league)
    {
        $linkBack = route('leagues', array(
            'tournament' => $tournament
        ));
        return view('league.show', compact('tournament', 'league', 'linkBack'));
    }

    public function edit(Tournament $tournament, League $league)
    {
        $linkBack = route('leagues', array(
            'tournament' => $tournament
        ));
        return view('league.edit', compact('tournament', 'league', 'linkBack'));
    }

    public function update(Tournament $tournament, League $league)
    {
        $rules = collect([
            'name' => 'required'
        ]);

        $validator = validator(request()->all(), $rules->toArray());
        if ($validator->fails()) {
            return redirect()->route('leagueEdit', array('tournament' => $tournament))->withErrors($validator)->withInput(request()->except('password'));
        }

        $league->name = request('name');
        $league->tournament_id = $tournament->id;
        $league->save();

        session('message', 'Successfully updated league');
        return redirect()->route('leagues', array('tournament' => $tournament));
    }

    public function destroy(Tournament $tournament, League $league)
    {
        $league->delete();

        session('message', 'Successfully deleted league');
        return redirect()->route('leagues', array('tournament' => $tournament));
    }

     public function settings(Tournament $tournament, League $league)
    {
        $settings = $league->settings;
        $id = $league->id;
        $tournamentid = $tournament->id;
        $linkBack = route('leagues', array(
            'tournament' => $tournament
        ));
        return view('league.settings', compact('id', 'tournamentid', 'settings', 'linkBack'));
    }

    public function storeSettings($id)
    {
        $rules = collect([
            'teams'  => 'required|numeric',
            'groups' => 'required|numeric',
            'qualifiedteams' => 'required|numeric',
            'isKO' => 'required'
        ]);

        $validator = validator(request()->all(), $rules->toArray());
        if ($validator->fails()) {
            return redirect()->route('leagueSettings',
                ['id' => $id])->withErrors($validator)->withInput(request()->except('password'));
        }

        $settings = collect();
        $settings->put('teams', intval(request('teams')))
            ->put('groups', intval(request('groups')))
            ->put('qualifiedteams', intval(request('qualifiedteams')))
            ->put('isKO', intval(request('isKO')));

        $item = League::find($id);
        $item->settings = $settings;
        $item->save();

        session()->flash('message', 'Successfully saved league settings');
        return redirect()->route('leagues', array(
             'tournament' => $item->tournament_id
        ));
    }
}
