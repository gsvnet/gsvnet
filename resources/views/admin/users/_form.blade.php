{!! Former::select('type')->label('Gebruikerssoort')->options(Config::get('gsvnet.userTypesFormatted')) !!}
{!! Former::text('username')->label('Gebruikersnaam') !!}
{!! Former::text('firstname')->label('Voornaam') !!}
{!! Former::text('middlename')->label('Tussenvoegsel') !!}
{!! Former::text('lastname')->label('Achternaam') !!}
{!! Former::text('email')->label('Emailadres') !!}
<div class="well bg-info">Wachtwoord hieronder leeg laten als je het niet wilt wijzigen</div>
{!! Former::password('password')->label('Nieuw wachtwoord') !!}
{!! Former::password('password_confirmation')->label('Nieuw wachtwoord herhalen') !!}