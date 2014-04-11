@section('content')
    <div class="column-holder" role="main">
        <p class="delta">
            @if(Auth::check())
                {{Auth::user()->firstname}}, 
                @if(Auth::user()->type == 'potential')
                    vanaf nu ga je een onvergetelijke studententijd tegemoet!
                @else
                    wil jij een onvergetelijke studententijd?</p>
                @endif
            @else
                Wil jij een onvergetelijke studententijd?
            @endif
        </p>
        <div class="main-content">
            <p>De GSV is de meest hechte christelijke studentenvereniging van Groningen. 
            Onze vereniging biedt de perfecte combinatie van christelijke waarden en het echte studentenleven.</p>
            <p>Je voelt je bij ons snel thuis te midden van actieve en betrokken medestudenten. 
            Wil jij een vereniging waar het geloof een centrale rol speelt, een vereniging met vele toffe, diverse activiteiten en weekenden en waar je vrienden voor het leven maakt?</p>
        </div>
        <div class="secondary-column">
            <p>Test</p>
        </div>
    </div>
@stop