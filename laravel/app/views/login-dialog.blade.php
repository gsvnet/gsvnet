<div id="login-dialog" class="zoom-anim-dialog mfp-hide">
    <h2>Login</h2>

    {{ Former::open()->action(action('SessionController@postLogin')) }}

        <p>Inloggen geeft je toegang tot het forum</p>


        @include('partials._login')

        <div class="form-group">
            <button type="submit" class="button">Log in</button>
        </div>
    {{ Former::close() }}
</div>