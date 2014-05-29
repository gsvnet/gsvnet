@extends('emails.layout')

@section('header')
Wachtwoord resetten
@stop

@section('content')
	<p>Klik hier om je wachtwoord te veranderen: {{ URL::action('RemindersController@getReset', array($token)) }}.</p>
	<p>Vriendelijke groetjes van de webcie.</p>
@stop