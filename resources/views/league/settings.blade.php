@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>League Settings</h1>

                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="{{ url()->route('leagueSettingsStore', ['tournament' => $tournamentid, 'league' => $id]) }}">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Aantal teams</label>
                        <input type="number" class="form-control" name="teams" value="{{ old('teams', $settings->get('teams')) }}" />
                    </div>

                    <div class="form-group">
                        <label>Aantal groepen</label>
                        <input type="number" class="form-control" name="groups" value="{{ old('groups', $settings->get('groups')) }}" />
                    </div>

                    <div class="form-group">
                        <label>Aantal teams die doorgaan naar volgende ronde</label>
                        <input type="number" class="form-control" name="qualifiedteams" value="{{ old('qualifiedteams', $settings->get('qualifiedteams')) }}" />
                    </div>

                    <div class="form-check">
                        <label class="form-check-label">
                            Volgende ronde is KO?
                            <input type="checkbox" class="form-check-input" name="isKO" @if (old('isKO', $settings->get('isKO'))) selected @endif >
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ $linkBack }}" class="btn btn-default">Back</a>

                </form>
            </div>
        </div>
    </div>
@stop