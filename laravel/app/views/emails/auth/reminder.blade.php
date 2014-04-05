@extends('emails.layout')

@section('title')
Wachtwoord resetten
@stop

@section('content')
	Klik hier om je wachtwoord te veranderen: {{ URL::to('password/reset', array($token)) }}.
@stop