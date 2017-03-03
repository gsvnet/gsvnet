@extends('layouts.default')

@section('title', 'Oud-leden')
@section('description', 'De GSV heeft bijna tweeduizend oud-leden sinds 1966')
@section('body-id', 'oud-leden-page')

@section('content')
    <article class="artikel column-holder" role="main">
        <div>
            <h1>Oud-leden van de GSV</h1>
            <p class="lead">De GSV heeft meer dan vijftienhonderd oud-leden. Jaarlijks wordt er een oud-ledenborrel georganiseerd.</p>
        </div>

        <h2>Lustrum 2016</h2>
        <h3>Musical 21 november</h3>

        <figure>
            <img src="/images/musical.jpg" width="960" alt="Musical 21 november 2016">
        </figure>

        <p>Kaartjes kunnen gereserveerd worden <a href="http://www.lustrumintense.nl/musical/">op de website</a>, maar kunnen ook aan de deur gekocht worden.</p>

        <h3>Oud-ledenborrel Dies 25 november</h3>

        <figure>
            <img src="/images/diesborrel.jpg" width="960" alt="Oud-ledenborrel 25 november 2016">
        </figure>

        <p>Opgave voor de borrel kan via <a href="http://www.lustrumintense.nl/dies.htm">http://www.lustrumintense.nl/dies.htm</a></p>

        <h3>Lustrumdies 25 november</h3>
        <p>U kunt zich vanaf heden opgeven voor de Dies Natalis die op vrijdag 25 november plaatsvindt. Als oud-lid bent u welkom vanaf 18:00, dan begint het amicitiadrinken. Aansluitend zal een heerlijk diner verzorgd worden, inclusief speeches en ander vermaak. Het feest wordt dit jaar in de stad Groningen gehouden, om precies te zijn in <a href="http://www.paradigm050.com/nl/">Paradigm</a>. Dit pand kunt u vinden aan de Helsinkilaan 6, vlak bij de Europaweg. Komt u nou bij dat pand aan en u denkt: 'Help, wat is dit? Zit ik wel goed?', stapt u dan vooral naar binnen, industrieel is hip.</p>

        <p>Meld u snel aan! Er is namelijk een beperkt aantal plekken vrij, er is capaciteit voor 250 mensen. Vol = vol! Voor oud-leden is het verder niet verplicht om met een date te komen, u kunt zich gewoon aanmelden.</p>
        <p><a href="http://www.lustrumintense.nl/dies.htm" class="button">Aanmelden</a></p>
        <p>Voor meer informatie en vragen kunt u mailen naar {!!HTML::mailto('malversacie@gsvnet.nl')!!}.</p>
    </article>
@stop