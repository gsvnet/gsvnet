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

        <h2>Oud-ledenborrel 29 april 2016</h2>
        <p>De jaarlijkse oudledenborrel voor reünisten van de GSV vindt dit jaar plaats op vrijdag 29 april. Vroeger was dit natuurlijk de nacht voor Koninginnedag, we brengen deze avond eenmalig terug voor onze oud-leden! We beginnen de avond met een pubquiz om 20:00. De Malversacie zal zorgen voor hapjes, foto's uit de oude doos, een geupdate stamboom en ander vermaak.
        <p>Nodig vooral leden uit uw jaarverband uit! Hoe meer zielen, hoe meer vreugd.</p>
        <p>Als je Facebook hebt, meld je dan aan op de <a href="https://www.facebook.com/events/587628854726340/">evenementpagina!</a> </p>
        <h2>Vragen?</h2>
        <p>Voor meer informatie en vragen kunt u mailen naar {!!HTML::mailto('malversacie@gsvnet.nl')!!}.</p>
        <figure>
            <img src="/images/oudleden.jpg" width="960" alt="Oud-ledenborrel 29 april 2016 bij Hereweg 40">
        </figure>
    </article>
@stop