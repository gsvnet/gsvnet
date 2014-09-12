{{ Former::select('region')->label('Gebruikerssoort')->options(Config::get('gsvnet.regions'))->placeholder('Geen') }}
{{ Former::select('year_group_id')->label('Jaarverband')->fromQuery($yearGroups, 'name', 'id') }}
{{ Former::select('reunist')->text('Reunist')->options(['0' => 'Nee', '1' => 'Ja']) }}

{{ Former::text('phone')->label('Telefoon') }}
{{ Former::text('address')->label('Adres') }}
{{ Former::text('zip_code')->label('Postcode') }}
{{ Former::text('town')->label('Woonplaats') }}
{{ Former::text('study')->label('Studie') }}
{{ Former::text('student_number')->label('Studentnummer') }}
{{ Former::text('birthdate')->label('Geboortedatum') }}
{{ Former::text('church')->label('Kerk') }}
{{ Former::select('gender')->label('Geslacht')->options(array('1' => 'Man', '0' => 'Vrouw')) }}
<div class="well">Onderstaande gaat alleen over ouders</div>
{{ Former::text('parent_phone')->label('Telefoon ouders') }}
{{ Former::text('parent_address')->label('Adres ouders') }}
{{ Former::text('parent_zip_code')->label('Postcode ouders') }}
{{ Former::text('parent_town')->label('Woonplaats ouders') }}