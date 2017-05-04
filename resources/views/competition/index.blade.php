@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Competitions</h1>
                <a href="{{ url()->route('competitionCreate') }}" class="btn btn-primary">Add Competition</a>
                <ul class="list-group">
                    @foreach($competitions as $competition)
                        <li class="list-group-item">
                            <a href="{{ url()->route('competitionShow', ['competition' => $competition]) }}">{{ $competition->name }}</a> /
                            <a href="{{ url()->route('competitionEdit', ['competition' => $competition]) }}">Edit</a> /
                            <form method="post" action="{{ url()->route('competitionDelete', ['competition' => $competition]) }}">
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
