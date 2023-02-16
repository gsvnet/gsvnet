@extends('layouts.default')

@section('title', 'De klachtencommissie')
@section('description', 'De klachtencommissie behandelt klachten die tijdens het novitiaat kunnen worden ingediend')

@section('content')
    <div class="column-holder" role="main">
        <div class="main-content">
            <h2>De klachtencommissie</h2>
            <p>
                De klachtencommissie is in het leven geroepen om klachten te behandelen over hoe leden van een vereniging zich hebben gedragen tegenover
                een (aspirant-)lid. Dat betekent dat niet alleen een regulier lid van de GSV een klacht kan indienen op het moment dat hij of zij
                vindt dat een ander lid zich serieus misdraagt, maar dat jij dat ook kunt doen. Wanneer er een klacht wordt ingediend, zal de
                klachtencommissie de GSV'er waarover de klacht gaat vragen zijn of haar kant van het verhaal te vertellen. Binnen drie weken zal de
                commissie een advies uitbrengen aan de Senaat over hoe het beste met de zaak om kan worden gegaan. Binnen nog eens drie weken zal
                de Senaat je dan laten weten wat er uit het onderzoek naar de klacht naar voren is gekomen, evenals wat de vervolgstappen zullen zijn.
            </p>
            <h4>Leden van de commissie</h4>
            <p>
                De klachtencommissie bestaat uit twee GSV'ers (een man en een vrouw) die niet in de novitiaatscommissie zitten.
                Het zijn ouderejaars die veel ervaring in de vereniging hebben en vertrouwelijk met de door jou gegeven informatie om
                zullen gaan. Dit jaar houden Joas Hakvoort en Wietske Visser zitting in deze commissie.
            </p>
        </div>
        <div class="secondary-column">
            <h2>Verdere vragen?</h2>
            <p>Kijk op de <a href="{{ URL::action([\App\Http\Controllers\MemberController::class, 'faq']) }}" title="Veel gestelde vragen">FAQ-pagina</a></p>
        </div>
    </div>
@stop