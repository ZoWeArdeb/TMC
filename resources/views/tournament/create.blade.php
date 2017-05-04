@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Tournament Create</h1>

                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="{{ url()->route('tournamentStore') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" />
                    </div>

                    <div class="form-group">
                        <label>Start Date</label>
                        <div class="input-group date">
                            <input type="text" class="form-control" name="startDate" value="{{ old('startDate') }}" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>End Date</label>
                        <div class="input-group date">
                            <input type="text" class="form-control" name="endDate" value="{{ old('endDate') }}" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ $linkBack }}" class="btn btn-default">Back</a>
                </form>
            </div>
        </div>
    </div>
@stop


