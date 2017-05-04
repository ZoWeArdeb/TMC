@extends('layout')

@section('content')
    <div class="container">
        @if (session()->has('message'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <p>{{ session('message') }}</p>
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <h1>Tournament Show</h1>
                <h2>{{ $item->name }}</h2>
                <a href="{{ url()->route('tournamentSettings', array('tournament' => $item)) }}" class="btn btn-primary">Settings</a>
                <a href="{{ url()->route('tournamentPreview', array('tournament' => $item)) }}" class="btn btn-primary">Preview</a>
                <a href="{{ url()->route('teams', array('tournament' => $item)) }}" class="btn btn-primary">Teams</a>
                <a href="{{ url()->route('leagues', array('tournament' => $item)) }}" class="btn btn-primary">Leagues</a>
                <a href="{{ url()->route('games', array('tournament' => $item)) }}" class="btn btn-primary">Games</a>
                <a href="{{ url()->route('tournamentRanking', array('tournament' => $item)) }}" class="btn btn-primary">Ranking</a>

                <hr />

                <a href="{{ url()->route('hulpTournamentGenerate', array('tournament' => $item)) }}" class="btn btn-primary">Generate</a>
                <a href="{{ url()->route('hulpFillScores', array('tournament' => $item)) }}" class="btn btn-primary">Fill All Scores</a>

                <hr />

                <a href="{{ $linkBack }}" class="btn btn-default">Back</a>
            </div>
        </div>
    </div>
@stop