@extends('layout')

@section('content')
    <div class="container">
        <div class="row">

            @foreach ($ranking as $league => $leagueTable)
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ $league }}</div>
                        <table class="table">
                            <tr>
                                <th>#</th>
                                <th>Team</th>
                                <th>Pld</th>
                                <th>W</th>
                                <th>D</th>
                                <th>L</th>
                                <th>+</th>
                                <th>-</th>
                                <th>+/-</th>
                                <th>Pts</th>
                            </tr>
                            @foreach ($leagueTable as $position => $rank)
                                <tr>
                                    <td>{{ $position }}</td>
                                    <td>{{ $rank->get('team')->get('name') }}</td>
                                    <td>{{ $rank->get('played') }}</td>
                                    <td>{{ $rank->get('win') }}</td>
                                    <td>{{ $rank->get('draw') }}</td>
                                    <td>{{ $rank->get('loss') }}</td>
                                    <td>{{ $rank->get('for') }}</td>
                                    <td>{{ $rank->get('against') }}</td>
                                    <td>{{ $rank->get('diff') }}</td>
                                    <td>{{ $rank->get('points') }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            @endforeach

            <div class="col-md-12">
                <a href="{{ $linkBack }}" class="btn btn-default">Back</a>
            </div>
        </div>
    </div>
@stop