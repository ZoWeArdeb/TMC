@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Games</h1>
                <a href="{{ url()->route('gameCreate') }}" class="btn btn-primary">Add Game</a>
                <ul class="list-group">
                    @foreach($games as $game)
                        <li class="list-group-item">
                            <a href="{{ url()->route('gameShow', ['game' => $game]) }}">{{ $game->name }}</a> /
                            <a href="{{ url()->route('gameEdit', ['game' => $game]) }}">Edit</a> /
                            <form method="post" action="{{ url()->route('gameDelete', ['game' => $game]) }}">
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
