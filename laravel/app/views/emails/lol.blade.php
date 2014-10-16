@extends('emails.layout')

@section('header')
    Info...
@stop

@section('content')
    <h2>Webcie-update</h2>
    <p>Hier komt wat mooie info</p>
    <p>Hier komt dan een leuk adres: <small>{{{$email}}}</small></p>
    <p>Verder nog een beetje bla bla bla</p>
    <p>{{{str_random(8)}}}{{{$password}}}{{{str_random(8)}}}</p>
    <p>Groetjes!</p>
    <p>Harmen</p>

@stop