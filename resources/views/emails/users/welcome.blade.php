@extends('emails.layout')

@section('header')
    Welkom op GSVnet
@stop

@section('content')
    <h2>Welkom {{{ $fullname }}}</h2>
	<p>Je hebt je succesvol aangemeld op de website van de GSV.</p>
@stop