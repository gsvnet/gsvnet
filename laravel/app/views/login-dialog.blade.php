<div id="login-dialog" class="dialog zoom-anim-dialog mfp-hide">
    <div class="dialog-main">
        <h2>Login</h2>

        {{ Former::open()->action(action('SessionController@postLogin')) }}

            <p>Inloggen geeft je toegang tot het forum</p>


            @include('partials._login')

            <div class="form-group">
                <button type="submit" class="button">Log in</button>
            </div>
        {{ Former::close() }}
    </div>
    <div class="dialog-footer">
        <h3>Geen account?</h3>
        {{ link_to_action('RegisterController@create', 'Registreer je dan nu!') }}
    </div>
</div>