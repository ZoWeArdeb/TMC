@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Tournament Game Edit</h1>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

                <form method="post" action="{{ url()->route('gameUpdate', array('game' => $game)) }}">
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $game->name) }}" />
                    </div>

                    <div class="form-group">
                        <label>Code</label>
                        <input type="text" class="form-control" name="code" value="{{ old('code', $game->code) }}" />
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="#" class="btn btn-default">Back</a>

                </form>
            </div>
        </div>
    </div>
@stop