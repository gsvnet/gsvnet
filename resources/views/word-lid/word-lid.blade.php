@extends('layouts.default')

@section('title', 'Lid worden bij de GSV!')
@section('description', 'Wil jij een vereniging waar het geloof een centrale rol speelt, een vereniging met vele toffe, diverse activiteiten en weekenden en waar je vrienden voor het leven maakt? Meld je aan!')
@section('body-id', 'become-member-page')

@section('content')

    <div id="lid-worden">
        @if($activeStep == 'login-or-register')
            <div class="column-holder" role="main">
                <h1>Word lid!</h1>
                <p class="delta">Supermooi dat je interesse hebt in de GSV! Volg de stappen om je aan te melden voor ons novitiaat. Dat duurt dit jaar van <strong>17 tot 26 augustus</strong>, houd deze dagen dus vrij!</p>
                <p>Voel je vooral vrij om voorafgaand aan het novitiaat mee te genieten van alle activiteiten die wij organiseren tijdens de KEIweek.</p>
            </div>
            @include('word-lid.become-member')
            
        @elseif($activeStep == 'all-done')
            <div class="column-holder">
                <h1>Gefeliciteerd!</h1>
                <p class="delta">Je hebt je officieel aangemeld bij de GSV</p>

                <p>Alvast bedankt voor je opgave! Wij nemen zo spoedig mogelijk per mail contact met je op voor specifieke informatie.</p>
            </div>
        @endif
    </div>
@stop

@section('word-lid')
@stop