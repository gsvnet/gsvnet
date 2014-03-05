@extends('emails.layout')

@section('header')
    <h1>Nieuwe gebruiker</h1>
@stop

@section('content')
    <h2>{{{ $user->full_name }}} heeft zich aangemeld.</h2>
    <p>Iemand moet hem nog even activeren als het geen bot is, maar het linkje hiervoor bestaat nog niet.</p>

    <h3>Gegevens van {{{ $user->full_name}}}</h3>
    <dl>
        <dt>Email</dt>
        <dd>{{{ $user->email }}}</dd>
    </dl>
@stop