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

                <p>Alvast bedankt voor je opgave! Je ontvangt zo spoedig mogelijk een mail met specifieke informatie. Neem contact op met de PRescie (prescie@gsvnet.nl) indien je binnen 15 minuten geen bevestigingsmail ontvangen hebt.</p>
            </div>
        @else
            @include('word-lid.become-member')
        @endif
    </div>
@stop

@section('word-lid')
@stop
