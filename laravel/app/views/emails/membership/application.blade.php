@extends('emails.layout')

@section('header')
    Aanmelding
@stop

@section('content')
    <p>Hier info over een nieuwe aanmelding. Zie de <a href="http://gsvnet.nl/admin">adminpagina</a> voor dezelfde info plus een eventuele foto!.</p>
    <pre>{{ var_dump($user) }}</pre>
@stop