@extends('emails.layout')

@section('header')
    <h1>Aanmelding word verwerkt</h1>
@stop

@section('content')
    <h2>Hoi {{{ $user->full_name }}}</h2>
    <p></p>
@stop