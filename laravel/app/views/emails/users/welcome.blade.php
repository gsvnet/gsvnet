@extends('emails.layout')

@section('header')
    <h1>Welkom op GSVnet</h1>
@stop

@section('content')
    <h2>Welkom {{{ $user->full_name }}}</h2>
	<p>Je hebt je succesvol aangemeld voor de website van de GSV.</p>
@stop