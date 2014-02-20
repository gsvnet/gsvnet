@section('content')
	<div class="column-holder">
	    <h2>Registreer</h2>
	    <p class="delta">Registreren geeft je toegang tot het forum</p>
		<div class="main-content">
			{{ Former::open()->action(URL::action('UserController@postRegister')) }}
			    {{ Former::text('register-username')->label('Gebruikersnaam')}}
			    {{ Former::text('register-firstname')->label('Voornaam')}}
			    {{ Former::text('register-middlename')->label('Tussenvoegsel')->size('3')}}
			    {{ Former::text('register-lastname')->label('Achternaam')}}
			    {{ Former::text('register-email')->label('Email')}}
			    {{ Former::password('register-password')->label('Wachtwoord')}}
			    {{ Former::password('register-password_confirmation')->label('Herhaal wachtwoord')}}
			    <div class="form-group">
			        <button type="submit" class="button">Registreer</button>
			    </div>
			{{Former::close()}}
		</div>
		<div class="secondary-column">
			<h2>Wat kun je nu</h2>
			<p>Als je je registeert kun je dit en dat</p>

			<h2>Voor zus en zo</h2>
			<p>Je kunt dat en dit</p>
		</div>
	</div>
@stop