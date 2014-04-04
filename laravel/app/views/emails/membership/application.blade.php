@extends('emails.layout')

@section('header')
    Aanmelding
@stop

@section('content')
    <p>Hier info over een nieuwe aanmelding.</p>
    <pre>
        {{ var_dump($user->toArray()) }}
    </pre>
@stop