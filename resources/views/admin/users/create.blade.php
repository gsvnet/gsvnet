@extends('layouts.admin')

@section('content')
{!! Former::open_vertical()->action(action('Admin\UsersController@store')) !!}
{!! Former::select('type')->label('Gebruikerssoort')->options(Config::get('gsvnet.userTypesFormatted')) !!}
{!! Former::text('username')->label('Gebruikersnaam') !!}
{!! Former::text('firstname')->label('Voornaam') !!}
{!! Former::text('middlename')->label('Tussenvoegsel') !!}
{!! Former::text('lastname')->label('Achternaam') !!}
{!! Former::text('email')->label('Emailadres') !!}
<div class="well bg-info">Wachtwoord leeg laten als je wil dat diegene het zelf moet instellen</div>
{!! Former::password('password')->label('Wachtwoord') !!}
{!! Former::password('password_confirmation')->label('Wachtwoord herhalen') !!}

{!! Former::submit('Registreren') !!}
{!! Former::close() !!}
@stop