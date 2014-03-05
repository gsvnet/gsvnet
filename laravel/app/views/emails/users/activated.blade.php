@extends('emails.layout')

@section('header')
    <h1>Account geactiveerd</h1>
@stop

@section('content')
    <h2>Hoi {{{ $user->full_name }}},</h2>
    <p>Je account is zojuist geactiveerd. Dit betekent dat je nu berichten kan plaatsen en hier nog wat andere info voor de gebruiker.</p>
@stop