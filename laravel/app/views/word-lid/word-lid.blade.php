@section('content')
    <div class="column-holder" role="main">
        <p class="delta">{{Auth::check() ? Auth::user()->firstname . ', w' : 'W'}}il jij een onvergetelijke studententijd?</p>
        <div class="main-content">
            <p>De GSV is de meest hechte christelijke studentenvereniging van Groningen. 
            Onze vereniging biedt de perfecte combinatie van christelijke waarden en het echte studentenleven.</p>
            <p>Je voelt je bij ons snel thuis te midden van actieve en betrokken medestudenten. 
            Wil jij een vereniging waar het geloof een centrale rol speelt, een vereniging met vele toffe, diverse activiteiten en weekenden en waar je vrienden voor het leven maakt? 
            Kortom: wil jij dit meemaken?</p>
        </div>
        <div class="secondary-column">
            <ul class="secondary-menu">
                <li><a href="#">Waarom lid worden?</a></li>
                <li><a href="#">Zus en zo?</a></li>
                <li><a href="#">Bla die bla?</a></li>
            </ul>
        </div>
    </div>
    <div class="hero-unit grey">
        <div class="column-holder form-steps">

            <p class="form-helper-text">Voortgang: </p>
            <ol>
                <li><a href="/" class="step-item">1. Inloggen of registreren</a></li>
                <li><a href="/" class="step-item active">2. Persoonlijke gegevens invullen</a></li>
                <li><span class="step-item">3. Klaar!</span></li>
            </ol>
        </div>
        @if(Auth::check())
            @include('word-lid.become-member')
        @else
            @include('word-lid.login-or-register')
        @endif
    </div>
@stop

@section('word-lid')
@stop