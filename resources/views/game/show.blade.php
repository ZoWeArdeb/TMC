@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Game Show</h1>
                <h2>{{ $game->name }}</h2>
            </div>
        </div>
        {{--<div class="row">--}}
            {{--<div class="col-md-12">--}}
                {{--<div class="panel panel-default">--}}
                    {{--<div class="panel-heading">Ranking</div>--}}
                    {{--<table class="table">--}}
                        {{--<tr>--}}
                            {{--<th>#</th>--}}
                            {{--<th>Game</th>--}}
                            {{--<th>Pld</th>--}}
                            {{--<th>W</th>--}}
                            {{--<th>D</th>--}}
                            {{--<th>L</th>--}}
                            {{--<th>+</th>--}}
                            {{--<th>-</th>--}}
                            {{--<th>+/-</th>--}}
                            {{--<th>Pts</th>--}}
                        {{--</tr>--}}
                        {{--@foreach ($tournament->getRankingByLeague($game->getLeague()->id) as $position => $rank)--}}
                            {{--<tr class="@if($rank->get('game')->get('id') == $game->id) bg-info @endif">--}}
                                {{--<td>{{ $position }}</td>--}}
                                {{--<td><a href="{{ url()->route('gameShow', array('tournament' => $tournament, 'game' => $rank->get('game')->get('id'))) }}">{{ $rank->get('game')->get('name') }}</a></td>--}}
                                {{--<td>{{ $rank->get('played') }}</td>--}}
                                {{--<td>{{ $rank->get('win') }}</td>--}}
                                {{--<td>{{ $rank->get('draw') }}</td>--}}
                                {{--<td>{{ $rank->get('loss') }}</td>--}}
                                {{--<td>{{ $rank->get('for') }}</td>--}}
                                {{--<td>{{ $rank->get('against') }}</td>--}}
                                {{--<td>{{ $rank->get('diff') }}</td>--}}
                                {{--<td>{{ $rank->get('points') }}</td>--}}
                            {{--</tr>--}}
                        {{--@endforeach--}}
                    {{--</table>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-12">--}}
                {{--<div class="panel panel-default">--}}
                    {{--<div class="panel-heading">Games</div>--}}
                    {{--<table class="table">--}}
                        {{--<tr>--}}
                            {{--<th>#</th>--}}
                            {{--<th>Game</th>--}}
                            {{--<th>Score</th>--}}
                        {{--</tr>--}}
                        {{--@foreach ($game->games as $game)--}}
                            {{--<tr>--}}
                                {{--<td>{{ $game->id }}</td>--}}
                                {{--<td><a href="{{ url()->route('gameShow', array('tournament' => $tournament, 'game' => $game->home)) }}">{{ $game->home->name }}</a> ---}}
                                    {{--<a href="{{ url()->route('gameShow', array('tournament' => $tournament, 'game' => $game->away)) }}">{{ $game->away->name }}--}}
                                {{--</td>--}}
                                {{--<td>{{ $game->score }}</td>--}}
                            {{--</tr>--}}
                        {{--@endforeach--}}
                    {{--</table>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="row">
            <div class="col-md-12">
                <a href="#" class="btn btn-default">Back</a>
            </div>
        </div>
    </div>
@stop