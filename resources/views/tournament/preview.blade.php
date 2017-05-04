@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Tournament Preview</h1>
                <h2>Groepsfase</h2>
                <div class="row">
                    @foreach($setup as $index => $group)
                        <div class="col-md-3">
                            <div class="panel panel-info">
                                <!-- Default panel contents -->
                                <div class="panel-heading">Groep {{ $index + 1}}</div>

                                <!-- List group -->
                                <ul class="list-group">
                                    @foreach($group as $team)
                                        <li class="list-group-item">{{ $team }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a href="{{ $linkBack }}" class="btn btn-default">Back</a>
            </div>
        </div>
    </div>
@stop