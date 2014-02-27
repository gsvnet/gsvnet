@section('content')
	<div class="column-holder">
		<h1>Verander je profiel</h1>
		<p class="delta">ALS EEN MODDERFOKKER!</p>

		{{ Former::open_vertical_for_files()->id('edit-profile-form') }}
		<div class="main-content">

			<h2>Persoonlijke gegevens</h2>
			{{ Former::populate(Auth::user()) }}

			<span for="potential-birth-day" class="control-label">Naam</span>
			<div class="inline-form-row">
				{{ Former::text('firstname')->label('')->disabled() }}
				{{ Former::text('middlename')->label('')->disabled()->size(5) }}
				{{ Former::text('lastname')->label('')->disabled() }}
			</div>
			{{ Former::text('username')->label('Gebruikersnaam')->disabled() }}
			{{ Former::text('email')->label('Email') }}

			<h2>Vul vooral meer in</h2>
			{{ Former::text('profile.church')->label('Kerkgezindte') }}
            {{ Former::text('profile.study')->label('Naam van studie') }}
            {{ Former::select('profile.start_date_rug')->range(date('Y')+1, date('Y')-4)->label('Jaar waarin je begon of begint met studeren') }}

            {{ Former::text('profile.address')->label('Adres') }}
            {{ Former::text('profile.zip_code')->label('Postcode')->size(6) }}
            {{ Former::text('profile.town')->label('Woonplaats') }}
            {{ Former::text('profile.phone')->label('Telefoon') }}
            {{ Former::select('profile.gender')->label('Geslacht')->options(array('male' => 'Man', 'female' => 'Vrouw')) }}

            <h2>Adres van je ouders</h2>
			{{ Former::text('profile.parent_address')->label('Adres ouders') }}
            {{ Former::text('profile.parent_zip_code')->label('Postcode ouders')->size(6) }}
            {{ Former::text('profile.parent_town')->label('Woonplaats ouders') }}
            {{ Former::text('profile.parent_phone')->label('Telefoon ouders') }}
		</div>
		<div class="secondary-column">
			<h2>Je profielfoto</h2>
			<div style="height:100px;background:grey;">
				
			</div>

			<h2>Je avatar</h2>
			<p>Je avatar kun je aanpassen op gravatar</p>

			<h2>Dingen die je niet kunt veranderen</h2>
			<p>Als je je naam, verjaardag of iets anders wat je niet kunt veranderen toch per se wil veranderen, dan moet je even contact op nemen met de abactis.</p>
		</div>

	</div>
    <div class="column-holder">
        <div class="control-group">
            <input type="submit" id="edit-profile-submit" value="Veranderen die hap" class="button">
        </div>
    </div>
	{{ Former::close() }}
@stop