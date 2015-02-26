@extends('emails.layout')

@section('header')
    Nieuwe gebruiker
@stop

@section('content')
    <h2>{{ $fullName }} heeft zich aangemeld.</h2>
    <p>Iemand moet hem nog even activeren als het geen bot is. Klik daarvoor op de link hieronder</p>

    {!! link_to_action('Admin\UsersController@index', 'Activeren') !!}
@stop