@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Tournament Game Create</h1>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

                <form method="post" action="{{ url()->route('gameStore') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label>Thuis</label>
                        <select name="home_team" class="form-control">
                            <option value="">Selecteer</option>
                            @foreach($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Uit</label>
                        <select name="away_team" class="form-control">
                            <option value="">Selecteer</option>
                            @foreach($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Score Thuis</label>
                        <input type="text" name="score_home" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label>Score Uit</label>
                        <input type="text" name="score_away" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label>Score Thuis Extra Time</label>
                        <input type="text" name="score_home_et" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label>Score Uit Extra Time</label>
                        <input type="text" name="score_away_et" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label>Score Thuis Penalty</label>
                        <input type="text" name="score_home_p" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label>Score Uit Penalty</label>
                        <input type="text" name="score_away_p" class="form-control" />
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="#" class="btn btn-default">Back</a>

                </form>
            </div>
        </div>
    </div>
@stop