@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Tournament Game Score Edit</h1>
                <form method="post" action="{{ url()->route('gameScoreUpdate', array('tournament' => $tournament, 'game' => $game)) }}">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ $game->home->name }}</label>
                                <input type="number" class="form-control" name="scoreHome" value="{{ old('scoreHome', $game->score_home) }}" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ $game->away->name }}</label>
                                <input type="number" class="form-control" name="scoreAway" value="{{ old('scoreAway', $game->score_away) }}" />
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                    {{--<a href="{{ $linkBack }}" class="btn btn-default">Back</a>--}}

                </form>
            </div>
        </div>
    </div>
@stop
