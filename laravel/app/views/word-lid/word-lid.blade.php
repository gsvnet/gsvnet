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
                <p class="delta">Supermooi dat je interesse hebt in de GSV! Volg de stappen om je aan te melden voor ons novitiaat. Dat duurt dit jaar van <strong>18 tot 27 augustus</strong>, houd deze dagen dus vrij!</p>
                <p>Voel je vooral vrij om voorafgaand aan het novitiaat mee te genieten van alle activiteiten die wij organiseren tijdens de KEIweek.</p>
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

                <p>Alvast bedankt voor je opgave! Wij nemen zo spoedig mogelijk per mail contact met je op voor specifieke informatie.</p>
            </div>
        @endif
    </div>
@stop

@section('word-lid')
@stop