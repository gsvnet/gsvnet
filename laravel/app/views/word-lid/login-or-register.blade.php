
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
                <div class="form-group">
                    <button type="submit" class="button">Log in</button>
                </div>
                <input type="hidden" name="become-member-login" value="1">
            {{Form::close()}}
        </div>

        <div id="register-form" class="register-form">
            {{ Form::open() }}
                <h2>Registreer</h2>
                <p>Heb je nog geen account? Maak er een aan!</p>
                <div class="form-group">
                    <label class="control-label" for="registerFirstname">Voornaam</label>
                    <input type="text" class="form-control" id="registerFirstname" name="registerFirstname" placeholder="Voornaam">
                </div>
                <div class="form-group">
                    <label class="control-label" for="registerMiddlename">Tussenvoegsel</label>
                    <input type="text" class="form-control" id="registerMiddlename" name="registerMiddlename" placeholder="Tussenvoegsel" size="3">
                </div>
                <div class="form-group">
                    <label class="control-label" for="registerLastname">Achternaam</label>
                    <input type="text" class="form-control" id="registerLastname" name="registerLastname" placeholder="Achternaam">
                </div>
                <div class="form-group">
                    <label class="control-label" for="registerEmail">Email</label>
                    <input type="text" class="form-control" id="registerEmail" name="registerEmail" placeholder="Email">
                </div>
                <div class="form-group">
                    <label class="control-label" for="registerPassword">Wachtwoord</label>
                    <input type="password" class="form-control" id="registerPassword" name="registerPassword" placeholder="Wachtwoord">
                </div>
                <div class="form-group">
                    <label class="control-label" for="registerPasswordRepeat">Herhaal wachtwoord</label>
                    <input type="password" class="form-control" id="registerPasswordRepeat" name="registerPasswordRepeat" placeholder="Herhaal wachtwoord">
                </div>
                <div class="form-group">
                    <button type="submit" class="button">Registreer</button>
                </div>
            {{Form::close()}}
        </div>
    </div>