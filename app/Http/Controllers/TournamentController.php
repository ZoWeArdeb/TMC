<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use Carbon\Carbon;
use App\Football\TournamentProcessor;
use Illuminate\Support\Collection;

class TournamentController extends Controller
{
    public function index()
    {
        $list = Tournament::all();
        return view('tournament.index', compact('list'));
    }

    public function create()
    {
        $linkBack = route('tournaments');
        return view('tournament.create', compact('linkBack'));
    }

    public function store()
    {
        $rules = collect([
            'name'     => 'required'
        ]);

        $validator = validator(request()->all(), $rules->toArray());
        if ($validator->fails()) {
            return redirect()->route('tournamentCreate')->withErrors($validator)->withInput(request()->except('password'));
        }

        $item             = new Tournament();
        $item->name       = request('name');
        $item->start_date = Carbon::parse(request('startDate'));
        $item->end_date   = Carbon::parse(request('endDate'));
        $item->save();

        session('message', 'Successfully created tournament');
        return redirect()->route('tournaments');
    }

    public function show($id)
    {
        $item     = Tournament::find($id);
        $linkBack = route('tournaments');

        return view('tournament.show', compact('item', 'linkBack'));
    }

    public function edit($id)
    {
        $item     = Tournament::find($id);
        $linkBack = route('tournaments');
        return view('tournament.edit', compact('item', 'linkBack'));
    }

    public function update($id)
    {
        $rules = collect([
            'name'     => 'required',
            'location' => 'required'
        ]);

        $validator = validator(request()->all(), $rules->toArray());
        if ($validator->fails()) {
            return redirect()->route('tournamentEdit',
                ['id' => $id])->withErrors($validator)->withInput(request()->except('password'));
        }

        $item             = Tournament::find($id);
        $item->name       = request('name');
        $item->location   = request('location');
        $item->start_date = Carbon::parse(request('startDate'));
        $item->end_date   = Carbon::parse(request('endDate'));
        $item->save();

        session('message', 'Successfully updated tournament');
        return redirect()->route('tournaments');
    }

    public function destroy($id)
    {
        $item = Tournament::find($id);
        $item->delete();

        session('message', 'Successfully deleted tournament');
        return redirect()->route('tournaments');
    }

    public function settings($id)
    {
        $item     = Tournament::find($id);
        $settings = $item->settings;
        $linkBack = route('tournamentShow', array(
            'id' => $id
        ));
        return view('tournament.settings', compact('id', 'settings', 'linkBack'));
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
            return redirect()->route('tournamentSettings',
                ['id' => $id])->withErrors($validator)->withInput(request()->except('password'));
        }

        $settings = collect();
        $settings->put('teams', intval(request('teams')))
            ->put('groups', intval(request('groups')))
            ->put('qualifiedteams', intval(request('qualifiedteams')))
            ->put('isKO', intval(request('isKO')));

        $item = Tournament::find($id);
        $item->settings = $settings;
        $item->save();

        session()->flash('message', 'Successfully saved tournament settings');
        return redirect()->route('tournamentShow', array(
            'id' => $id
        ));
    }

    public function preview(Tournament $tournament)
    {
        /** @var Collection $settings */
        $settings = $tournament->settings;
        $setup = collect();

        $teamsPerGroup = intval(floor($settings->get('teams') / $settings->get('groups')));
        $rest = $settings->get('teams') % $settings->get('groups');

        for($x = 0; $x < $settings->get('groups'); $x++) {
            $group = collect();
            for($y = 1; $y <= $teamsPerGroup; $y++) {
                $group->push('Team ' . ($teamsPerGroup * $x + $y));
            }
            $setup->push($group);
        }

        for($i = 0; $i < $rest; $i++) {
            $setup->get($i)->push('Team ' . ($teamsPerGroup * $settings->get('groups') + $i + 1));
        }

        $winnersPerGroup = floor($settings->get('final_stages') / $settings->get('groups'));



        $linkBack = route('tournamentShow', array(
            'tournament' => $tournament
        ));
        return view('tournament.preview', compact('setup', 'linkBack'));
    }

    public function ranking(Tournament $tournament) {
        $ranking = $tournament->ranking()->with('team', 'league')->get();

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
        })->groupBy('league.name');

        $linkBack = route('tournamentShow', array(
            'tournament' => $tournament
        ));

        return view('tournament.ranking', compact('ranking', 'linkBack'));
    }
}
