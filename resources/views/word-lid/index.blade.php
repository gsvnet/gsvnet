@extends('layouts.default')

@section('title', 'Word lid bij de GSV Groningen')
@section('description', 'Wil jij een fantastische studententijd? Meld je dan aan bij de GSV Groningen')

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
            <p>De GSV is de meest hechte christelijke studentenvereniging van Groningen. Onze vereniging biedt de perfecte combinatie van christelijke waarden en het echte studentenleven.</p>
            <p>Door onze lange historie heen hebben wij keer op keer bewezen de beste match te zijn tussen het échte studentenleven en het christelijk geloof.</p>

            <h2>Open soos</h2>
            <p>Een aantal keer per jaar organiseert de GSV een open sociëteitsavond waar je op je gemak kunt kennismaken met de vereniging en het pand kunt bekijken. Vaak organiseren we voorafgaand aan een open soos een andere activiteit die een van de aspecten van onze vereniging belicht. Ook kun je op een normale donderdagavond mee als introducé van een van onze leden.</p>

            <p>Kijk gauw in het jaarschema hieronder wat we dit jaar allemaal speciaal voor jou organiseren:</p>
            <ul>
                <li>Open soos: 12 april 2015</li>
                <li>Open soos: 28 mei 2015</li>
                <li>Keiweek 10-14 augustus 2015</li>
            </ul>

            <h2>Open kring</h2>
            <p>Elke dinsdag wordt er bijbelkring gehouden binnen de GSV. Een groep van ongeveer 8 GSV’ers gaat eerst lekker eten, om vervolgens gezamenlijk met een geloofsonderwerp aan de slag te gaan. Na de bijbelkring wordt er vaak nog even gezellig wat gedronken. Wil je een keertje deze bijbelkring meemaken? Stuur een mail naar {!!HTML::mailto('prescie@gsvnet.nl')!!} en beleef de avond zelf!</p>

            <h2>Meeloopdag</h2>
            <p>Weet je nog niet wat je gaat studeren? Binnen de GSV worden tal van studies gedaan. Stuur een mail naar {!!HTML::mailto('prescie@gsvnet.nl')!!} en wij koppelen je aan een GSV’er om hoor- of werkcolleges van een studie te volgen, zodat je je beter kunt oriënteren op je studiekeuze.</p>
        </div>
        <div class="secondary-column">
            <h2>Gelijk inschrijven</h2>
            <p><a href="{{ URL::action('MemberController@becomeMember') }}" class="button" title="Meld je aan">Meld je aan!</a></p>

            <h2>Vragen?</h2>
            <p>Kijk op de <a href="{{ URL::action('MemberController@faq') }}" title="Veel gestelde vragen">FAQ-pagina</a></p>
        </div>
    </div>
@stop