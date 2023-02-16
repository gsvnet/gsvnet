@extends('layouts.default')

@section('title', 'Q&A Corona')
@section('description', 'Antwoorden op vragen over het coronavirus')

@section('content')

    <div class="column-holder" role="main">
        <div class="main-content">
            <div>
                <h2>Vragen over de GSV en Corona</h2>
                <br>
                <h3>Waar kan ik terecht met mijn vragen over de GSV?</h3>
                <p>Voor vragen of meer informatie over de GSV kun je mailen naar {!! HTML::mailto('prescie@gsvnet.nl') !!}, een appje sturen naar 0610269363 of een DM sturen naar onze instagram {!! HTML::link('https://www.instagram.com/gsvgroningen/', '@gsvgroningen') !!}. Voor een aantal kun je terecht bij het kopje ‘Veelgestelde vragen’. Voor vragen over lid worden bij de GSV in tijden van corona kun je hieronder terecht.</p>

                <h3>Hoe kan ik lid worden van de GSV?</h3>
                <p>Om lid te worden moet je je allereerst inschrijven voor 23 augustus. Daarnaast moet je onze introductietijd (“novitiaat") doorlopen. Dit zal dit jaar niet doorgaan door alle maatregelen rondom corona. Er wordt gewerkt aan een alternatieve  manier van kennismaken. Wil je op de hoogte blijven? Stuur een mailtje naar {!! HTML::mailto("prescie@gsvnet.nl") !!}.</p>

                <h3>Heeft het wel zin om lid te worden van de GSV in de coronaperiode?</h3>
                <p>Ook tijdens de coronacrisis heeft de GSV een geweldige meerwaarde. Nu de RUG en de Hanze voor een groot gedeelte na de zomer verder gaan met online lesgeven, kan het moeilijk zijn om contact te maken met medestudenten. Dan biedt een studentenvereniging echt een uitkomst. Ook nu organiseren we tal van activiteiten die betrekking hebben op onze vier pijlers: christelijk, intellectueel, studentikoos en sociaal. Door middel van online activiteiten of activiteiten op afstand blijven we ondanks de crisis toch betrokken bij elkaar. Daarnaast gaan we onze sociëteit zo in te richten dat we elkaar straks toch weer op anderhalve meter kunnen ontmoeten. Zo zorgen we ervoor dat jij ook nu de tijd van je leven kunt hebben.</p>

                <h3>Wat is het novitiaat?</h3>
                <p>Het novitiaat is de introductieperiode van de GSV. Tijdens deze week maak je kennis met de activiteiten en de structuur van de GSV en maak je kennis met je jaarverband. Door de coronamaatregelen gaat deze week helaas niet door. Er wordt echter gewerkt aan een alternatieve manier van kennismaken.</p>

                <h3>Gaat het novitiaat dit jaar wel door?</h3>
                <p>Het novitiaat gaat dit jaar helaas niet door. Er wordt gewerkt aan een alternatieve manier om kennis te maken met de GSV.</p>

                <h3>Wordt er tijdens het novitiaat ook rekening gehouden met de coronamaatregelen?</h3>
                <p>Tijdens het novitiaat wordt uiteraard rekening gehouden met de richtlijnen van het RIVM en de GGD. We houden de ontwikkelingen in de gaten en maken afspraken met de RUG/Hanze, zodat we de veiligheid van onze aspirant-leden kunnen waarborgen.</p>

                <h3>Wat gebeurt er als het novitiaat niet door kan gaan?</h3>
                <p>Momenteel zijn we druk bezig met het opstellen van een plan voor een alternatieve introductieperiode. Hierbij wordt rekening gehouden met alle mogelijke scenario’s. We doen ons best je zo veel mogelijk op de hoogte te houden van de veranderingen via de website en onze sociale media. Wil je direct op de hoogte blijven? Stuur dan een mailtje naar {!! HTML::mailto('prescie@gsvnet.nl') !!}.</p>

                <h3>Hoe kan ik op de hoogte worden gehouden van de veranderingen van het novitiaat?</h3>
                <p>Je kan op de hoogte blijven van veranderingen door een mailtje te sturen naar {!! HTML::mailto('prescie@gsvnet.nl') !!}. Daarnaast zullen wij ons best doen onze website zo veel mogelijk te updaten bij eventuele veranderingen.</p>
            </div>
        </div>
        <div class="secondary-column">
            <h2>Verdere vragen?</h2>
            <p>Kijk op de <a href="{{ URL::action([\App\Http\Controllers\MemberController::class, 'faq']) }}" title="Veel gestelde vragen">FAQ-pagina</a></p>
        </div>
    </div>
@stop
