@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Tournament Settings</h1>

                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="{{ url()->route('tournamentSettingsStore', ['id' => $id]) }}">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Aantal Teams</label>
                        <input type="number" class="form-control" name="teams" value="{{ old('teams', $settings->get('teams')) }}" />
                    </div>

                    <div class="form-group">
                        <label>Aantal groepen</label>
                        <input type="number" class="form-control" name="groups" value="{{ old('groups', $settings->get('groups')) }}" />
                    </div>

                    <div class="form-group">
                        <label>Eindronde</label>
                        <select class="form-control" name="final_stages">
                            <option value="">-- Selecteer --</option>
                            <option value="2" @if (old('final_stages', $settings->get('final_stages')) == 2) selected @endif>Finale</option>
                            <option value="4" @if (old('final_stages', $settings->get('final_stages')) == 4) selected @endif>Halve finale</option>
                            <option value="8" @if (old('final_stages', $settings->get('final_stages')) == 8) selected @endif>Kwartfinale</option>
                            <option value="16" @if (old('final_stages', $settings->get('final_stages')) == 16) selected @endif>1/8 finale</option>
                            <option value="32" @if (old('final_stages', $settings->get('final_stages')) == 32) selected @endif>1/16 finale</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ $linkBack }}" class="btn btn-default">Back</a>

                </form>
            </div>
        </div>
    </div>
@stop