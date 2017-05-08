@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Teams</h1>
                <a href="{{ url()->route('teamCreate', array('tournament' => $tournament)) }}" class="btn btn-primary">Add Team</a>
                <ul class="list-group">
                    @foreach($teams as $team)
                        <li class="list-group-item">
                            <a href="{{ url()->route('teamShow', ['team' => $team,'tournament' => $tournament]) }}">{{ $team->name }}</a> /
                            <a href="{{ url()->route('teamEdit', ['team' => $team,'tournament' => $tournament]) }}">Edit</a> /
                            <form method="post" action="{{ url()->route('teamDelete', ['team' => $team,'tournament' => $tournament]) }}">
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
