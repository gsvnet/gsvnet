@extends('layouts.default')

@section('title', 'Verander je gegevens')
@section('description', 'Verander je gegevens')
@section('body-id', 'edit-profile-page')

@section('content')
	<div class="column-holder">
		<h1>Verander je profiel</h1>

		@if($errors->count() > 0)
		    <div style="padding:1em;background:#FF5F5F">
                <strong>Je hebt iets verkeerd ingevuld!</strong>
                @foreach($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
		    </div>
        @endif
		
		{!! Former::open_vertical_for_files()
            ->action(action('UserController@updateProfile'))
            ->id('edit-profile-form') !!}
		<div class="main-content">
			<h2>Persoonlijke gegevens</h2>
			{!! Former::populate(Auth::user()) !!}

			{!! Former::text('username')->label('Gebruikersnaam')->disabled() !!}
			<label for="firstname" class="control-label">Voornaam, tussenvoegsel, achternaam</label>
			<div class="inline-form-row">
				{!! Former::text('firstname')->label('')->disabled() !!}
				{!! Former::text('middlename')->label('')->size(5)->disabled() !!}
				{!! Former::text('lastname')->label('')->disabled() !!}
			</div>

			{!! Former::text('email')->label('Email') !!}

			@if( Permission::has('users.edit-profile') && isset($profile) )

				<h2>Vul vooral meer in</h2>
			    {!! Former::text('profile.initials')->label('Initialen')->size(5) !!}
	            {!! Former::text('profile.birthdate')->label('Geboortedatum')->help('jjjj-mm-dd') !!}
				{!! Former::text('profile.church')->label('Kerkgezindte') !!}
	            {!! Former::text('profile.study')->label('Naam van studie') !!}
	            {!! Former::text('profile.student_number')->label('Studentnummer') !!}

	            {!! Former::text('profile.address')->label('Adres') !!}
	            {!! Former::text('profile.zip_code')->label('Postcode')->size(6) !!}
	            {!! Former::text('profile.town')->label('Woonplaats') !!}
	            {!! Former::text('profile.phone')->label('Telefoon') !!}
	            {!! Former::select('profile.gender')->label('Geslacht')->options(['1' => 'Man', '0' => 'Vrouw']) !!}

	            <h2>Adres van je ouders</h2>
	            {!! Former::stacked_radios('parent_same_address')->radios([
                    'Ja' => array('name' => 'parent_same_address', 'value' => '1'),
                    'Nee' => array('name' => 'parent_same_address', 'value' => '0')
                ])->label('Woon je bij je ouders/verzorgers?')->check('0') !!}

	            <div id="parents-info">
	    			{!! Former::text('profile.parent_address')->label('Adres ouders') !!}
	                {!! Former::text('profile.parent_zip_code')->label('Postcode ouders')->size(6) !!}
	                {!! Former::text('profile.parent_town')->label('Woonplaats ouders') !!}
	            </div>

                {!! Former::text('profile.parent_phone')->label('Telefoon ouders') !!}
	        @else
	        	<p>De rest van je GSV-profielgegevens worden binnenkort toegevoegd!</p>
	        @endif
		</div>
		<div class="secondary-column">
			@if(Permission::has('users.edit-profile') && isset($profile))
				<h2>Je profielfoto</h2>
				<p>{{ Auth::user()->profile->present()->xsmallProfileImage }}</p>
	            {!! Former::file('profile.photo_path')->label('Upload een foto van jezelf')->accept('image') !!}
	        @endif

			<h2>Je avatar</h2>
			<p>Je avatar kun je aanpassen op <a href="http://nl.gravatar.com/" title="Je avatar aanpassen">Gravatar</a>.</p>

			<h2>Dingen die je niet kunt veranderen</h2>
			<p>Als je regio/lidmaatschap niet klopt of je je gebruikersnaam wilt veranderen, dan moet je even contact op nemen met de webcie of de abactis.</p>
		</div>
	</div>
    <div class="column-holder">
        <div class="control-group">
            <input type="submit" id="edit-profile-submit" value="Veranderen die hap" class="button">
        </div>
    </div>
	{!! Former::close() !!}
@stop