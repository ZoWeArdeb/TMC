<?php

namespace App\Http\Controllers;

use App\Models\League;
use App\Models\Tournament;
use App\Models\Team;

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
                /** @var Collection $settings */
        $settings = $league->settings;
        $setup = collect();

        $teamsPerGroup = intval(floor($settings->get('teams') / $settings->get('groups')));
        $rest = $settings->get('teams') % $settings->get('groups');

        $leagueteams = $league->teams()->get()->shuffle();
        $countleagueteams = count($leagueteams);
        $leagueitems = 0;
        for($x = 0; $x < $settings->get('groups'); $x++) {
            $group = collect();
            for($y = 1; $y <= $teamsPerGroup; $y++) {
                if($teamsPerGroup * $x + $y > $countleagueteams)
                {
                    $randomteam = new Team();
                    $randomteam->name = 'Team ' . ($teamsPerGroup * $x + $y);
                    $randomteam->id = 0;
                    $group->push($randomteam);
                }
                else
                {
                    $group->push($leagueteams[$leagueitems]);
                    $leagueitems++;
                }
            }
            $setup->push($group);
        }

        for($i = 0; $i < $rest; $i++) {
            $setup->get($i)->push('Team ' . ($teamsPerGroup * $settings->get('groups') + $i + 1));
        }

        $winnersPerGroup = floor($settings->get('final_stages') / $settings->get('groups'));

        $linkBack = route('leagues', array(
            'tournament' => $tournament
        ));
        $teams = $league->teams();

        return view('league.show', compact('tournament', 'league','setup', 'linkBack'));
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

    public function storeSettings(Tournament $tournament, League $league)
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
            ->put('isKO', boolval(request('isKO')));
        $item = League::find($league->id);
        $item->settings = $settings;
        $item->save();

        session()->flash('message', 'Successfully saved league settings');
        return redirect()->route('leagues', array(
             'tournament' => $item->tournament_id
        ));
    }
}
