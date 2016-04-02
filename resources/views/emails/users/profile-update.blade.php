@extends('emails.layout')

@section('header')
    Profielwijziging
@stop

@section('content')
    <h2>Profiel {{ $user->present()->fullName() }}</h2>
    <p>Beste abactis, bovenstaande persoon heeft zijn profiel gewijzigd.</p>
    <p>Voor meer informatie zie <a href="{{ action('Admin\UsersController@show', $user->id) }}" title="GSV admin">de admin-pagina</a></p>

    <p>Liefs, de webcie.</p>
@stop