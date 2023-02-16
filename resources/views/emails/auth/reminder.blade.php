@extends('emails.layout')

@section('header')
Wachtwoord resetten
@stop

@section('content')
	<p>Klik hier om je wachtwoord te veranderen:</p> 
	<p>{!! action([\App\Http\Controllers\RemindersController::class, 'getReset'], [$token]) !!}</p>
	<p>Vriendelijke groetjes van de webcie.</p>
@stop