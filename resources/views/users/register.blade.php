@extends('layouts.default')

@section('title', 'Registreren op GSVnet')
@section('description', 'Geregistreerde leden hebben toegang tot het forum van de GSV')
@section('body-id', 'show-register')

@section('content')
    <div class="column-holder">
        <h2>Registreer</h2>
        <p class="delta">Registreren geeft je toegang tot het forum</p>
        <div class="main-content">
            {!! Former::open()->action(URL::action('RegisterController@store')) !!}

                @include('partials._register')

                <div class="form-group">
                    <button type="submit" class="button">Registreer</button>
                </div>
            {!!Former::close()!!}
        </div>
        <div class="secondary-column">
            <h2>Wat kun je hierna doen</h2>
            <p>Als je je registeert krijg je toegang tot het forum. Dit is niet hetzelfde als je aanmelden voor de GSV.</p>
        </div>
    </div>
@stop