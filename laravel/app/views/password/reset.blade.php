@section('content')

    <div class="column-holder">
        @if (Session::has('error'))
            {{ Session::get('error') }}
        @endif

        {{ Former::open()->action(action('RemindersController@postReset'))}}
            {{ Former::hidden('token', $token)}}
            {{ Former::email('email') }}
            {{ Former::password('password') }}
            {{ Former::password('password_confirmation') }}

            <input type="submit" value="Reset Password">
        {{ Former::close() }}
    </div>
@stop