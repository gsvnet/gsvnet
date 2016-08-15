@extends('layouts.default')

@section('title', 'Veelgestelde vragen!')
@section('description', 'Wat je moet weten over de studentenvereniging GSV')
@section('body-id', 'faq-page')

@section('content')
    <div class="column-holder" role="main">
        <h1>Veelgestelde vragen</h1>
        <p class="delta">Lees wat je wilt weten voor je lid wordt!</p>
        <div class="main-content">
            <h2 id="hoe">Hoe word ik lid?</h2>
            <p>Je kunt je zowel via de site als in de sociëteit aanmelden.</p>
            <p><a href="{{URL::action('MemberController@becomeMember')}}" title="Word lid!" class="button">Word lid!</a></p>

            <h2 id="voor-wie">Kan iedereen lid worden?</h2>
            <p>Alleen mensen die aan de RuG, of aan een gelijkwaardige opleiding (dus universiteit), staan ingeschreven, kunnen lid worden. Hiermee is de GSV uniek; wij zijn de laatste universitaire studentenvereniging van Groningen. Mocht je aan de Hanzehogeschool gaan studeren, dan verwijzen we je graag door naar onze broedervereniging Ad Tempus Vitae. Kijk eens op hun website: <a href="http://www.adtempusvitae.nl">www.adtempusvitae.nl</a>. Tenslotte kun je slechts lid worden na het doorlopen van het Novitiaat, waarover hieronder meer.</p>

            <h2 id="18-jaar">Ik ben onder de 18, maakt dat uit?</h2>
            <p>Iedereen die ingeschreven staat bij de RuG of gelijkwaardige instantie kan lid worden, dus ook als je onder de 18 bent. Wel is sinds januari 2014 de alcoholgrens opgeschoven naar 18 jaar. Dit wordt bij de GSV dan ook gewoon gehandhaafd.</p>

            <h2 id="eerste-jaar">Hoe ziet mijn eerste jaar bij GSV eruit?</h2>
            <p>In het eerste jaar van je studentenleven komt er een boel op je af. Nieuwe stad, (voor het eerst) op kamers, met alle vrijheden en verantwoordelijkheden die daarbij komen kijken enzovoort. Daarom staat bij de GSV kennismaking centraal in je eerste jaar. In de regel doen eerstejaars bij ons geen commissies, zodat ze alle tijd hebben voor studie, het bezoeken van activiteiten en heel belangrijk: op je gemak tijd nemen om de mensen van je jaarverband en de rest van de vereniging beter te leren kennen. De regel hierbij is wel: investeren is incasseren. Bezoek je lekker de activiteiten en ga je mee op de weekenden, dan zul je je snel goed op je gemak voelen bij ons.</p>

            <h2 id="gereformeerd">Ik ken het ‘gereformeerde wereldje’ nu wel. Is de GSV wel iets voor mij?</h2>
            <p>Ja natuurlijk wel! De naam Gereformeerde Studentenvereniging schrikt een boel mensen af. Onterecht vinden wij, want een ieder die komt kijken moet al gauw zijn mening bijschaven. Kom dus vooral even kennismaken tijdens een van onze open sociëteitsavonden.</p>

            <h2 id="verplichtingen">Veel verplichtingen?</h2>
            <p>Op dinsdagavond hebben wij standaard onze bijbelkringavonden, hiervan wordt verwacht dat je daarbij bent. Verder is elke donderdagavond de sociëteit geopend. Niet verplicht, wel een leuke gelegenheid om iedereen weer even te zien en op de hoogte te blijven van wat er gebeurt. Voor de rest geldt er wat de beschrijving van het eerste jaar ook al genoemd wordt: hoe meer tijd je investeert, hoe meer contacten bij de vereniging en hoe meer plezier je hieraan zult beleven.</p>

            <h2 id="studie">Is de GSV te combineren met je studie?</h2>
            <p>Elk jaar blijkt dat de GSV en studeren goed samengaan. Bij het plannen van activiteiten wordt rekening gehouden met jouw studiemomenten. Daarnaast zijn er activiteiten die het studeren bevorderen. Kijk voor meer informatie op <a href="{{ URL::action('MemberController@study') }}" title="GSV en studie">deze pagina</a>.</p>

            <h2 id="uniek">Wat is het verschil tussen GSV en andere christelijke studentenverenigingen? Wat maakt de GSV uniek?</h2>
            <p>De GSV is de beste combinatie tussen de christelijke basis en alles wat het studentenleven te bieden heeft. Daar waar andere christelijke verenigingen de punten gezelligheid en studentikoziteit reduceren tot de wekelijkse borrel is onze vereniging ermee doorvlochten. Niet alleen bijbel en bier, maar ook tradities, mores, een novitiaat dat je uitdaagt jezelf echt voor 100% ergens voor in te zetten enzovoort. Daarnaast heeft de GSV een unieke structuur die ervoor zorgt dat wij een zeer hechte vereniging zijn. Wat dat laatste inhoudt valt het beste te merken tijdens een van onze open sociëteitsavonden. Kom dus vooral eens kijken en ervaar zelf wat ons anders maakt!</p>

            <h2 id="kosten">Wat kost dat?</h2>
            <p>De contributie, of Hoofdelijke Omslag zoals wij het noemen, bedraagt €150,- per jaar. Dit is inclusief de bijdrage van €40,- per jaar voor de sociëteit. De hoofdelijke omslag is gelijk voor iedereen, dus als jongerejaars hoef je niet meer te betalen dan iemand die al langer lid is.</p>
            <p>Voor sommige grote activiteiten of weekenden weg is het wel normaal dat je voor die specifieke activiteiten wat extra’s betaalt.</p>

            <h2 id="intentieverklaring">Wat is nou die intentieverklaring?</h2>
            <p>De intentieverklaring luidt als volgt: </p>

            <blockquote>
                <p>"Ik wil lid worden van de Gereformeerde Studentenvereniging te Groningen, een studentenvereniging waarin geloofsverdieping, sociale omgang, intellectuele vorming en studentikoziteit belangrijk zijn. Ik hecht aan de gereformeerde identiteit van de vereniging. De gereformeerde traditie is belangrijk voor mijn persoonlijk geloof in de God van de Bijbel. Vanuit mijn geloof wil ik mij inzetten voor de vereniging en haar doel, elkaar als leden te steunen in het dienen van de Here, met name in de studie. Ik onderwerp mij aan wat in de statuten, reglementen en besluiten is bepaald."</p>
            </blockquote>

            <h2 id="novitiaat">Wat is het Novitiaat?</h2>
            <p>Het novitiaat is een intensieve kennismaking met de GSV, welke anderhalve week duurt. Hierbij ga je eerst een week op kamp waar je kennis kunt maken met de structuur en activiteiten van de GSV. Ook leer je je eigen jaarverband goed kennen. In de halve week daarna maak je kennis met de GSV-leden zelf door allerlei bruisende activiteiten in de stad. Het novitiaat van de GSV heeft een ontgroenend karakter.</p>
            <p>Dit jaar is het novitiaat van maandag 22 tot woensdag 31 augustus.</p>

            <h2 id="bevestiging">Ik heb me aangemeld, maar geen bevestiging ontvangen. Wat nu?</h2>
            <p>Het is mogelijk dat er iets mis is gegaan tijdens het aanmelden voor de GSV. Heb je geen ontvangstbevestiging per mail gekregen nadat je je hebt aangemeld? Neem dan even contact op met de PRescie via {!! HTML::mailto('prescie@gsvnet.nl') !!}.</p>

            <h2 id="vragen">Meer vragen?</h2>
            <p>Neemt contact op met de Prescie: {!! HTML::mailto('prescie@gsvnet.nl') !!}</p>
        </div>
        <div class="secondary-column">
            <ul class="secondary-menu">
                <li><a href="#hoe" title="Lees hoe je lid wordt">Hoe word ik lid?</a></li>
                <li><a href="#voor-wie" title="Lees over voor wie het is">Voor wie is de GSV?</a></li>
                <li><a href="#18-jaar" title="Lees over 18 jaar">18 jaar?</a></li>
                <li><a href="#eerste-jaar" title="Lees over je eerste jaar">Eerste jaar?</a></li>
                <li><a href="#gereformeerd" title="Lees over gereformeerd">Gereformeerd?</a></li>
                <li><a href="#verplichtingen" title="Lees over verplichtingen">Verplichtingen?</a></li>
                <li><a href="#studie" title="Lees over het combineren van studie en GSV">Studie & GSV?</a></li>
                <li><a href="#uniek" title="Lees over wat de GSV bijzonder maakt">Uniek?</a></li>
                <li><a href="#kosten" title="Lees over kosten">Kosten?</a></li>
                <li><a href="#intentieverklaring" title="Lees over de intentieverklaring">Intentieverklaring?</a></li>
                <li><a href="#novitiaat" title="Lees over het novitiaat">Novitiaat?</a></li>
                <li><a href="#vragen" title="Stel een vraag">Meer vragen?</a></li>
            </ul>
        </div>
    </div>
@stop