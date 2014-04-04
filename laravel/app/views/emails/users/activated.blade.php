@extends('emails.layout')

@section('header')
    Account geactiveerd
@stop

@section('content')
    <h2>Hoi {{{ $user->full_name }}},</h2>
    <p>Je account is zojuist geactiveerd. Dit betekent dat je nu berichten kan plaatsen op het forum.</p>
@stop