@section('content')

    <div id="lid-worden">
        <div class="column-holder form-steps">

            <p class="form-helper-text">Voortgang: </p>
            <ol>
                @foreach ($steps as $type => $data)
                    <li><span class="step-item{{{$type==$activeStep ? ' active' : ''}}}">{{$data['text']}}</span></li>
                @endforeach
            </ol>
        </div>
        @if($activeStep == 'login-or-register')
            <div class="column-holder" role="main">
                <h1>Word lid!</h1>
                <p class="delta">Voordat je je aan kunt melden bij de Gereformeerde Studentenvereniging Groningen, moet je eerst een account aanmaken op de website</p>
            </div>
            @include('word-lid.login-or-register')

        @elseif($activeStep == 'become-member')
            <div class="column-holder" role="main">
                <h1>Word lid!</h1>
                <p class="delta">{{Auth::user()->firstname}}, door onderstaand formulier in te vullen meld je je aan bij de Gereformeerde Studentenvereniging Groningen</p>
            </div>
            @include('word-lid.become-member')
            
        @elseif($activeStep == 'all-done')
            <div class="column-holder">
                <h1>Gefeliciteerd!</h1>
                <p class="delta">Je hebt je officieel aangemeld bij de GSV</p>

                <p>Je ontvangt zo spoedig mogelijk een mail met belangrijke informatie.</p>
            </div>
        @endif
    </div>
@stop

@section('word-lid')
@stop