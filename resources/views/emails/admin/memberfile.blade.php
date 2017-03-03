@extends('emails.layout')

@section('header')
    Ledenbestand
@stop

@section('content')
    <h2>Het ledenbestand van {{ $month }} {{ $year }}.</h2>
    <p>Dag abactis, lekker ding,</p>

    <p>Bij dezen het nieuwe ledenbestand. Geniet ervan, h&egrave;!</p>

    <p>Kusjes,</p>

    <p>CRON</p>
@stop