@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Tournament</h1>
                <a href="{{ url()->route('tournamentCreate') }}" class="btn btn-primary">Add Tournament</a>
                <ul class="list-group">
                    @foreach($list as $item)
                        <li class="list-group-item">
                            <a href="{{ url()->route('tournamentShow', ['tournament' => $item->id]) }}">{{ $item->name }}</a> /
                            <a href="{{ url()->route('tournamentEdit', ['tournament' => $item->id]) }}">Edit</a> /
                            <form method="post" action="{{ url()->route('tournamentDelete', ['tournament' => $item->id]) }}">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit">Delete</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@stop