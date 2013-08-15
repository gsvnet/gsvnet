<div id="login-dialog" class="zoom-anim-dialog mfp-hide">
    <h2>Login</h2>
    <form method='post' action='/login'>

        {{ Form::token() }}

        <div class="form-group">
            <label class="control-label" for="inputEmail">Email</label>
            <input type="text" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email">
        </div>
        <div class="form-group">
            <label class="control-label" for="inputPassword">Wachtwoord</label>
            <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Wachtwoord">
        </div>
        <div class="form-group">
            <label class="checkbox">
                <input type="checkbox"> Onthoud mij
            </label>
        </div>
        <div class="form-group">
            <button type="submit" class="button">Log in</button>
        </div>
    </form>
</div>