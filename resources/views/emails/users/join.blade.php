@extends('emails.layout')

@section('header')
    Lid!
@stop

@section('content')
    <h2>Beste {{ $fullname }}</h2>
    <p>Je hebt zojuist een fantastische keuze in je leven gemaakt door je officieel aan te melden bij de GSV!</p>
    <p>De Prescie zal zo spoedig mogelijk contact met je opnemen en je meer informatie geven over het novitiaat.</p>
    <p>Vriendelijke groeten namens de webcie!</p>
@stop