
    <div class="column-holder" role="main">
        <h1>Meld je aan!</h1>
        <p class="delta">Voordat je je aan kunt melden bij de Gereformeerde Studentenvereniging Groningen, moet je eerst een account aanmaken op de website</p>
    </div>
    <div class="column-holder">
        <div id="login-form" class="login-form">
            {{ Form::open(array('route' => 'post-login')) }}
                <h2>Login</h2>
                <p>Heb je al een bestaand account? Log dan in!</p>
                <div class="form-group{{Session::has('login_errors') ? ' has-error' : ''}}">
                    <label class="control-label" for="inputEmail">Email</label>
                    <input type="text" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email">
                </div>
                <div class="form-group{{Session::has('login_errors') ? ' has-error' : ''}}">
                    <label class="control-label" for="inputPassword">Wachtwoord</label>
                    <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Wachtwoord">
                </div>
                <input type="hidden" name="become-member-login" value="1">
                <div class="form-group">
                    <button type="submit" class="button">Log in</button>
                </div>
            {{Form::close()}}
        </div>

        <div id="register-form" class="register-form">
            {{ Former::open()->action(URL::route('post-register')) }}
                <h2>Registreer</h2>
                <p>Heb je nog geen account? Maak er een aan!</p>
                {{ Former::text('register-username')->label('Gebruikersnaam')}}
                {{ Former::text('register-firstname')->label('Voornaam')}}
                {{ Former::text('register-middlename')->label('Tussenvoegsel')->size('3')}}
                {{ Former::text('register-lastname')->label('Achternaam')}}
                {{ Former::text('register-email')->label('Email')}}
                {{ Former::password('register-password')->label('Wachtwoord')}}
                {{ Former::password('register-password_confirmation')->label('Herhaal wachtwoord')}}
                <input type="hidden" name="become-member-register" value="1">
                <div class="form-group">
                    <button type="submit" class="button">Registreer</button>
                </div>
            {{Former::close()}}
        </div>
    </div>