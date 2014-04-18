<div class="form-group{{Session::has('login_errors') ? ' has-error' : ''}}">
    <label class="control-label" for="inputEmail">Email</label>
    <input type="text" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email">
</div>

<div class="form-group{{Session::has('login_errors') ? ' has-error' : ''}}">
    <label class="control-label" for="inputPassword">Wachtwoord</label>
    <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Wachtwoord">
</div>

<div class="form-group">
    <label class="checkbox" for="remember">
        <input type="checkbox" id="remember" name="remember"> Onthoud mij
    </label>
</div>

<div class="form-group">
    <a href="{{ URL::action('RemindersController@getRemind') }}">
        Wachtwoord vergeten?
    </a>
</div>