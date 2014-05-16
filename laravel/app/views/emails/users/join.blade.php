@extends('emails.layout')

@section('header')
    Lid!
@stop

@section('content')
    <h2>Hoi {{{ $user->fullName }}}</h2>
    <p>Je hebt je aangemeld bij de GSV</p>
    <p>Je krijgt meer info van de novcie</p>
    <p>Groetjes namens de webcie</p>
@stop