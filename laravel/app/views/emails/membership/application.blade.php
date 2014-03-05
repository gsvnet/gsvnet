@extends('emails.layout')

@section('header')
    <h1>Aanmelding</h1>
@stop

@section('content')
    <p>Hier info over een nieuwe aanmelding.</p>
    <pre>
        {{ var_dump($user->toArray()) }}
    </pre>
@stop