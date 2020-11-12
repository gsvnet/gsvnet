@extends('layouts.default')

@section('title', 'Nieuw wachtwoord aanvragen')
@section('description', 'Nieuw wachtwoord aanvragen')

@section('content')
    <div class="column-holder">
        <h1>Klein beetje dom schat</h1>
        @if (Session::has('status'))
            {{ Session::get('status') }}
        @endif

        @if (Session::has('error'))
            {{ Session::get('error') }}
        @endif

        {!! Former::open()->action(URL::action('RemindersController@postEmail')) !!}
        {!! Former::text('email')->label('Je emailadres') !!}
        <div class="control-group">
            <input type="submit" id="submit" value="Stuur mij een reset-link" class="button">
        </div>
        {!! Former::close() !!}
    </div>
@stop