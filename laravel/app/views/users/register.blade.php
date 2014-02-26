@section('content')
    <div class="column-holder">
        <h2>Registreer</h2>
        <p class="delta">Registreren geeft je toegang tot het forum</p>
        <div class="main-content">
            {{ Former::open()->action(URL::action('RegisterController@store')) }}

                @include('partials._register')

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