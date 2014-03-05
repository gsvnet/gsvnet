@section('content')
    <div class="column-holder">
        <h1>Balen zeg</h1>
        @if (Session::has('status'))
            {{ Session::get('status') }}
        @endif

        @if (Session::has('error'))
            {{ Session::get('error') }}
        @endif

        {{ Former::open()->action(URL::action('RemindersController@postRemind')) }}
        {{ Former::text('email')->label('Je emailadres') }}
        <div class="control-group">
            <input type="submit" id="submit" value="Stuur nieuw wachtwoord" class="button">
        </div>
        {{ Former::close() }}
    </div>
@stop