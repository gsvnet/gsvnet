@extends('layouts.default')

@section('title', 'Lid worden bij de GSV!')
@section('description', 'Wil jij een vereniging waar het geloof een centrale rol speelt, een vereniging met vele toffe, diverse activiteiten en weekenden en waar je vrienden voor het leven maakt? Meld je aan!')
@section('body-id', 'become-member-page')

@section('content')

    <div id="lid-worden">
        @if(Auth::check() && Auth::user()->isPotential())
            <div class="column-holder">
                <h1>Gefeliciteerd!</h1>
                <p class="delta">Je hebt je officieel aangemeld bij de GSV</p>

                <p>Alvast bedankt voor je opgave! Je ontvangt zo spoedig mogelijk een mail met specifieke informatie. Neem contact op met de PRescie (prescie@gsvnet.nl) indien je binnen een uur geen bevestiginsmail ontvangen hebt.</p>
            </div>
        @else
            <div class="column-holder" role="main">
                <h1>Word lid!</h1>
                <p class="delta">Supermooi dat je interesse hebt in de GSV! Volg de stappen om je aan te melden voor de GSV. Gewoonlijk dien je dan ook onze introductieperiode te doorlopen (het "novitiaat"), maar die gaat vanwege Corona helaas niet door. Er wordt gewerkt aan een alternatieve manier van kennismaken met de vereniging.</p>
                <p>Voel je vooral vrij om voorafgaand aan het novitiaat mee te genieten van alle activiteiten die wij organiseren tijdens de KEIweek.</p>
            </div>
            @include('word-lid.become-member')

        @endif
    </div>
@stop

@section('word-lid')
@stop
