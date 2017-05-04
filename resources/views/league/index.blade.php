@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Tournament Leagues</h1>
                <a href="{{ url()->route('leagueCreate', array('tournament' => $tournament)) }}" class="btn btn-primary">Add League</a>
                <ul class="list-group">
                    @foreach($tournament->leagues as $league)
                        <li class="list-group-item">
                            <a href="{{ url()->route('leagueShow', ['tournament' => $tournament, 'league' => $league]) }}">{{ $league->name }}</a> /
                            <a href="{{ url()->route('leagueEdit', ['tournament' => $tournament, 'league' => $league]) }}">Edit</a> /
                            <form method="post" action="{{ url()->route('leagueDelete', ['tournament' => $tournament, 'league' => $league]) }}">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit">Delete</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <a href="{{ $linkBack }}" class="btn btn-default">Back</a>
            </div>
        </div>
    </div>
@stop
