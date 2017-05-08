@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Tournament Team Create</h1>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

                <form method="post" action="{{ url()->route('teamStore', array('tournament' => $tournament)) }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" />
                    </div>

                    <div class="form-group">
                        <label>League</label>
                          <select class="form-control" name="league">
                            @foreach($tournament->leagues as $league)
                              <option value="{{$league->id}}">{{$league->name}}</option>
                            @endforeach
                          </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ $linkBack }}" class="btn btn-default">Back</a>

                </form>
            </div>
        </div>
    </div>
@stop