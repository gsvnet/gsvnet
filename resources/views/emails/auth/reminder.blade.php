@extends('emails.layout')

@section('header')
Wachtwoord resetten
@stop

@section('content')
	<p>Klik hier om je wachtwoord te veranderen:</p> 
	<p>{!! action('RemindersController@getReset', [$token]) !!}</p>
	<p>Vriendelijke groetjes van de webcie.</p>
@stop