@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Competition Show</h1>
                <h2>{{ $competition->name }}</h2>
            </div>
        </div>
        {{--<div class="row">--}}
            {{--<div class="col-md-12">--}}
                {{--<div class="panel panel-default">--}}
                    {{--<div class="panel-heading">Ranking</div>--}}
                    {{--<table class="table">--}}
                        {{--<tr>--}}
                            {{--<th>#</th>--}}
                            {{--<th>Competition</th>--}}
                            {{--<th>Pld</th>--}}
                            {{--<th>W</th>--}}
                            {{--<th>D</th>--}}
                            {{--<th>L</th>--}}
                            {{--<th>+</th>--}}
                            {{--<th>-</th>--}}
                            {{--<th>+/-</th>--}}
                            {{--<th>Pts</th>--}}
                        {{--</tr>--}}
                        {{--@foreach ($tournament->getRankingByLeague($competition->getLeague()->id) as $position => $rank)--}}
                            {{--<tr class="@if($rank->get('competition')->get('id') == $competition->id) bg-info @endif">--}}
                                {{--<td>{{ $position }}</td>--}}
                                {{--<td><a href="{{ url()->route('competitionShow', array('tournament' => $tournament, 'competition' => $rank->get('competition')->get('id'))) }}">{{ $rank->get('competition')->get('name') }}</a></td>--}}
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
                        {{--@foreach ($competition->games as $game)--}}
                            {{--<tr>--}}
                                {{--<td>{{ $game->id }}</td>--}}
                                {{--<td><a href="{{ url()->route('competitionShow', array('tournament' => $tournament, 'competition' => $game->home)) }}">{{ $game->home->name }}</a> ---}}
                                    {{--<a href="{{ url()->route('competitionShow', array('tournament' => $tournament, 'competition' => $game->away)) }}">{{ $game->away->name }}--}}
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