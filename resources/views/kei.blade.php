@extends('layouts.default')

@section('title', 'KEI-week 2020')
@section('description', 'Bekijk hier het programma van de GSV in de KEI-week van 2020!')

@section('content')

    <article class="artikel column-holder">
        <div>
            <h1>KEI-week 2020</h1>
            <p class="lead">Wat leuk dat je een kijkje neemt op onze KEI-week-pagina! Van 10-14 augustus zal de KEI-week plaatsvinden en ben je van harte welkom op onze sociëteit! Het programma van deze week vind je hieronder. Naast de activiteiten kunnen we je natuurlijk ook een rondleiding geven door ons pand en ben je van harte welkom om gezellig met ons een drankje te drinken.</p>
        </div>

        <img src="/images/KEI2020.jpg" alt="Programma KEI-week"> <br>

        <p>
            <br>
            Als vanzelfsprekend houden we rekening met de coronamaatregelen van de horeca. Daaronder valt dat je vooraf moet reserveren. Dit betekent dat je je moet opgeven voor de activiteiten die op de poster staan. Het opgaveformulier zal te zijner tijd gedeeld worden. 
            Ook zal de GSV te zien zijn op het online platform dat opgezet is door het dagelijks bestuur van stichting KEI in de vorm van Q&A’s en de specifieke video. Houd voor al onze updates deze pagina in de gaten en volg ons op {!! HTML::link('https://www.instagram.com/gsvgroningen', 'Instagram') !!} en {!! HTML::link('https://nl-nl.facebook.com/GSVgroningen', 'Facebook') !!}.

            <br>
            Wij hebben er zin in en hopen dat je net zo enthousiast bent als de KEI-commissie die deze week voor jou organiseert!
        </p>
        <h2>Running dinner</h2>
        <p>
            11 augustus, van 18:00-22:00 met aansluitend een pubquiz (optioneel). Het is een driegangendiner, waarbij je in tweetallen bij elke gang naar een andere locatie mag gaan. Je kan je samen opgeven, maar ook alleen. In dat geval zullen wij je koppelen aan iemand met wie je de avond langs alle gerechten zult gaan.
            Opgeven kan tot 10 augustus 20:00.

            <br>
            Klik {!! link_to('https://forms.gle/2jLqG7ZyFbLDEVN28', 'hier', ['target' => '_blank']) !!} om je op te geven!
        </p>
        <p>
            <img src="/images/keicie.jpg" alt="KEI-commissie">
            De KEI-commissie, van links naar rechts zie je: Tim, Sarena, Nienke, Michelle, Aniek en Lydia.
        </p>
    </article>
@stop
