@extends('emails.layout')

@section('header')
    <h1>Nieuwe gebruiker</h1>
@stop

@section('content')
    <h2>{{{ $user->full_name }}} heeft zich aangemeld.</h2>
    <p>Iemand moet hem nog even activeren als het geen bot is. Klik daarvoor op de link hieronder</p>

    {{ link_to_action('Admin\UsersController@activate') }}

    <h3>Gegevens van {{{ $user->full_name}}}</h3>
    <dl>
        <dt>Email</dt>
        <dd>{{{ $user->email }}}</dd>
    </dl>
@stop