
    <div class="column-holder" role="main">
        <h1>Meld je aan!</h1>
        <p class="delta">Voordat je je aan kunt melden bij de Gereformeerde Studentenvereniging Groningen, moet je eerst een account aanmaken op de website</p>
    </div>
    <div class="column-holder">
        <div id="register-form" class="half-column">
            {{ Former::open()->action(URL::action('RegisterController@create')) }}
                <h2>Registreer</h2>
                <p>Heb je nog geen account? Maak er een aan!</p>

                @include('partials._register')

                <input type="hidden" name="become-member-register" value="1">
                <div class="form-group">
                    <button type="submit" class="button">Registreer</button>
                </div>
            {{Former::close()}}
        </div>

        <div id="login-form" class="half-column with-border">
            {{ Former::open()->action(action('SessionController@postLogin')) }}
                <h2>Login</h2>
                <p>Heb je al een bestaand account? Log dan in!</p>

                @include('partials._login')

                <input type="hidden" name="become-member-login" value="1">
                <div class="form-group">
                    <button type="submit" class="button">Log in</button>
                </div>
            {{ Former::close() }}
        </div>
    </div>