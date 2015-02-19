@extends('emails.layout')

@section('header')
    Aanmelding {{{ $fullname }}}
@stop

@section('content')
    <p>Zie ook de <a href="http://gsvnet.nl/admin">adminpagina</a>!</p>

    <p><strong>Opmerkingen van de noviet</strong></p>
    <p><em>{{ $input['additional-information'] }}</em></p>

    <table>
    	<tr>
    		<td>Voornaam: </td>
    		<td>{{ $user['firstname'] }}</td>
		</tr>
    	<tr>
    		<td>Tussenvoegsel: </td>
    		<td>{{ $user['middlename'] }}</td>
		</tr>
    	<tr>
    		<td>Achternaam: </td>
    		<td>{{ $user['lastname'] }}</td>
		</tr>
    	<tr>
    		<td>Email: </td>
    		<td>{{ $user['email'] }}</td>
		</tr>
		<tr>
			<td>----</td>
			<td>----</td>
		</tr>
    	<tr>
    		<td>Geslacht: </td>
    		<td>{{ $profile['gender'] }}</td>
		</tr>
    	<tr>
    		<td>Telefoon: </td>
    		<td>{{ $profile['phone'] }}</td>
		</tr>
    	<tr>
    		<td>Adresgegevens: </td>
    		<td>
    			{{ $profile['address'] }}<br/>
    			{{ $profile['zip_code'] }} {{ $profile['town'] }}
    		</td>
		</tr>
    	<tr>
    		<td>Kerk: </td>
    		<td>{{ $profile['church'] }}</td>
		</tr>
		<tr>
			<td>----</td>
			<td>----</td>
		</tr>
		<tr>
			<td>Naam studie:</td>
			<td>{{ $profile['study'] }}</td>
		</tr>
		<tr>
			<td>Jaar inschrijving RUG:</td>
			<td>{{ $input['potential-study-start-year'] }}</td>
		</tr>
		<tr>
			<td>Studentnummer:</td>
			<td>{{ $profile['student_number'] }}</td>
		</tr>
		<tr>
			<td>----</td>
			<td>----</td>
		</tr>
		<tr>
			<td>Adresgegevens ouders: </td>
    		<td>
    			{{ $profile['parent_address'] }}<br/>
    			{{ $profile['parent_zip_code'] }} {{ $profile['parent_town'] }}
    		</td>
		</tr>
		<tr>
			<td>Telefoon ouders: </td>
			<td>{{ $profile['parent_phone'] }}</td>
		</tr>
		<tr>
			<td>Emailadres ouders: </td>
			<td>{{ $input['parents-email'] }}</td>
		</tr>
    </table>
@stop