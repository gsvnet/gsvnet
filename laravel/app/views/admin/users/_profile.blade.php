{{ Former::select('region')->label('Gebruikerssoort')->options(Config::get('gsvnet.regions'))->placeholder('Geen') }}
{{ Former::select('year_group_id')->label('Jaarverband')->fromQuery($yearGroups, 'name', 'id') }}
{{ Former::checkbox('reunist')->text('Reunist')->label('') }}

{{ Former::text('phone')->label('Telefoon') }}
{{ Former::text('address')->label('Adres') }}
{{ Former::text('zip_code')->label('Postcode') }}
{{ Former::text('town')->label('Woonplaats') }}
{{ Former::text('study')->label('Studie') }}
{{ Former::text('student_number')->label('Studentnummer') }}
{{ Former::text('birthdate')->label('Geboortedatum') }}
{{ Former::text('church')->label('Kerk') }}
{{ Former::text('gender')->label('Geslacht') }}
<div class="well">Onderstaande gaat alleen over ouders</div>
{{ Former::text('parent_phone')->label('Telefoon ouders') }}
{{ Former::text('parent_address')->label('Adres ouders') }}
{{ Former::text('parent_zip_code')->label('Postcode ouders') }}
{{ Former::text('parent_town')->label('Woonplaats ouders') }}