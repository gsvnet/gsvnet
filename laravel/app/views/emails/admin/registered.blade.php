@extends('emails.layout')

@section('header')
    Nieuwe gebruiker
@stop

@section('content')
    <h2>{{{ $user->fullName }}} heeft zich aangemeld.</h2>
    <p>Iemand moet hem nog even activeren als het geen bot is. Klik daarvoor op de link hieronder</p>

    {{ link_to_action('Admin\UsersController@activate', 'Activeren', [$user->id]) }}

    <h3>Gegevens van {{{ $user->fullName}}}</h3>
    <dl>
        <dt>Email</dt>
        <dd>{{{ $user->email }}}</dd>
    </dl>
@stop