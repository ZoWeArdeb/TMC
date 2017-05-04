@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Competition Create</h1>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

                <form method="post" action="{{ url()->route('competitionStore') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" />
                    </div>

                    <div class="form-group">
                        <label>Code</label>
                        <input type="text" class="form-control" name="code" value="{{ old('code') }}" />
                    </div>

                    <div class="form-group">
                        <label>Parent</label>
                        <select name="parent" class="form-control">
                            <option value="">Selecteer</option>
                            @foreach($competitions as $competition)
                                <option value="{{ $competition->id }}">{{ $competition->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="#" class="btn btn-default">Back</a>

                </form>
            </div>
        </div>
    </div>
@stop