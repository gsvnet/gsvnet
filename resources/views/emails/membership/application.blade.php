@extends('emails.layout')

@section('header')
    Aanmelding {{{ $fullname }}}
@stop

@section('content')
    <p>Zie ook de <a href="http://gsvnet.nl/admin">adminpagina</a>!</p>

    <p><strong>Opmerkingen van de noviet</strong></p>
    <p><em>{{ $personal_message }}</em></p>

	<p><strong>School</strong></p>
	<p><em>{{ $school }}</em></p>

    <table>
    	<tr>
    		<td style="font-family:'PT Serif', Georgia, 'Times New Roman', Times, serif;font-size:18px;line-height:30px;padding:8px 16px;"><strong>Voornaam</strong></td>
    		<td style="font-family:'PT Serif', Georgia, 'Times New Roman', Times, serif;font-size:18px;line-height:30px;padding:8px 16px;">{{ $user['firstname'] }}</td>
		</tr>
    	<tr>
    		<td style="font-family:'PT Serif', Georgia, 'Times New Roman', Times, serif;font-size:18px;line-height:30px;padding:8px 16px;"><strong>Tussenvoegsel</strong></td>
    		<td style="font-family:'PT Serif', Georgia, 'Times New Roman', Times, serif;font-size:18px;line-height:30px;padding:8px 16px;">{{ $user['middlename'] }}</td>
		</tr>
    	<tr>
    		<td style="font-family:'PT Serif', Georgia, 'Times New Roman', Times, serif;font-size:18px;line-height:30px;padding:8px 16px;"><strong>Achternaam</strong></td>
    		<td style="font-family:'PT Serif', Georgia, 'Times New Roman', Times, serif;font-size:18px;line-height:30px;padding:8px 16px;">{{ $user['lastname'] }}</td>
		</tr>
    	<tr>
    		<td style="font-family:'PT Serif', Georgia, 'Times New Roman', Times, serif;font-size:18px;line-height:30px;padding:8px 16px;"><strong>Email</strong></td>
    		<td style="font-family:'PT Serif', Georgia, 'Times New Roman', Times, serif;font-size:18px;line-height:30px;padding:8px 16px;">{{ $user['email'] }}</td>
		</tr>
		<tr>
			<td style="font-family:'PT Serif', Georgia, 'Times New Roman', Times, serif;font-size:18px;line-height:30px;padding:8px 16px;"><strong>Geboortedatum</strong></td>
			<td style="font-family:'PT Serif', Georgia, 'Times New Roman', Times, serif;font-size:18px;line-height:30px;padding:8px 16px;">{{ $birthdate }}</td>
		</tr>
    	<tr>
    		<td style="font-family:'PT Serif', Georgia, 'Times New Roman', Times, serif;font-size:18px;line-height:30px;padding:8px 16px;"><strong>Geslacht</strong></td>
    		<td style="font-family:'PT Serif', Georgia, 'Times New Roman', Times, serif;font-size:18px;line-height:30px;padding:8px 16px;">{{ $gender }}</td>
		</tr>
    	<tr>
    		<td style="font-family:'PT Serif', Georgia, 'Times New Roman', Times, serif;font-size:18px;line-height:30px;padding:8px 16px;"><strong>Telefoon</strong></td>
    		<td style="font-family:'PT Serif', Georgia, 'Times New Roman', Times, serif;font-size:18px;line-height:30px;padding:8px 16px;">{{ $profile['phone'] }}</td>
		</tr>
    	<tr>
    		<td style="font-family:'PT Serif', Georgia, 'Times New Roman', Times, serif;font-size:18px;line-height:30px;padding:8px 16px;"><strong>Adresgegevens</strong></td>
    		<td style="font-family:'PT Serif', Georgia, 'Times New Roman', Times, serif;font-size:18px;line-height:30px;padding:8px 16px;">
    			{{ $profile['address'] }}<br/>
    			{{ $profile['zip_code'] }} {{ $profile['town'] }}
    		</td>
		</tr>
		<tr>
			<td style="font-family:'PT Serif', Georgia, 'Times New Roman', Times, serif;font-size:18px;line-height:30px;padding:8px 16px;"><strong>Naam studie</strong></td>
			<td style="font-family:'PT Serif', Georgia, 'Times New Roman', Times, serif;font-size:18px;line-height:30px;padding:8px 16px;">{{ $profile['study'] }}</td>
		</tr>
		<tr>
			<td style="font-family:'PT Serif', Georgia, 'Times New Roman', Times, serif;font-size:18px;line-height:30px;padding:8px 16px;"><strong>Jaar inschrijving RUG</strong></td>
			<td style="font-family:'PT Serif', Georgia, 'Times New Roman', Times, serif;font-size:18px;line-height:30px;padding:8px 16px;">{{ $startYear }}</td>
		</tr>
		<tr>
			<td style="font-family:'PT Serif', Georgia, 'Times New Roman', Times, serif;font-size:18px;line-height:30px;padding:8px 16px;"><strong>Studentnummer</strong></td>
			<td style="font-family:'PT Serif', Georgia, 'Times New Roman', Times, serif;font-size:18px;line-height:30px;padding:8px 16px;">{{ $profile['student_number'] }}</td>
		</tr>
		<tr>
			<td style="font-family:'PT Serif', Georgia, 'Times New Roman', Times, serif;font-size:18px;line-height:30px;padding:8px 16px;"><strong>Adresgegevens ouders</strong></td>
    		<td style="font-family:'PT Serif', Georgia, 'Times New Roman', Times, serif;font-size:18px;line-height:30px;padding:8px 16px;">
    			{{ $profile['parent_address'] }}<br/>
    			{{ $profile['parent_zip_code'] }} {{ $profile['parent_town'] }}
    		</td>
		</tr>
		<tr>
			<td style="font-family:'PT Serif', Georgia, 'Times New Roman', Times, serif;font-size:18px;line-height:30px;padding:8px 16px;"><strong>Telefoon ouders</strong></td>
			<td style="font-family:'PT Serif', Georgia, 'Times New Roman', Times, serif;font-size:18px;line-height:30px;padding:8px 16px;">{{ $profile['parent_phone'] }}</td>
		</tr>
    </table>
@stop