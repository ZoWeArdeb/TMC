@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Teams</h1>
                <a href="{{ url()->route('teamCreate') }}" class="btn btn-primary">Add Team</a>
                <ul class="list-group">
                    @foreach($teams as $team)
                        <li class="list-group-item">
                            <a href="{{ url()->route('teamShow', ['team' => $team]) }}">{{ $team->name }}</a> /
                            <a href="{{ url()->route('teamEdit', ['team' => $team]) }}">Edit</a> /
                            <form method="post" action="{{ url()->route('teamDelete', ['team' => $team]) }}">
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
                <a href="#" class="btn btn-default">Back</a>
            </div>
        </div>
    </div>
@stop
