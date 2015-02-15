@extends('layouts.default')

@section('title', 'Senaten van de GSV')
@section('description', 'De GSV wordt bestuurd door een senaat die bestaat uit een vijftal functies: praeses, abactis, fiscus, assessor primus en assessor secundus.')
@section('body-id', 'senates-page')

@section('content')

    <div class="column-holder">
        <h1>Senaten</h1>
        <p class="delta">Aan het hoofd van de vereniging staat de Senaat, bestaande uit drie tot vijf leden. Deze Senaat bestuurt de GSV en houdt het overzicht over haar vele activiteiten.</p>
        <div class="secondary-column">
            @include('de-gsv.senates._list')
        </div>
        <div class="main-content" role="main">
        @section('senate')

            <p>
                De vijf functies binnen de Senaat zijn die van praeses, abactis, fiscus, assessor primus en assessor secundus. Deze vijf houden zich respectievelijk bezig met het voorzitten van de vereniging, het bijhouden van de ledenadministratie en de post, de financiële kant van de GSV, de externe relaties en de interne commissies. Samen vormen zij een jaar lang een hecht team dat elk jaar probeert het beste uit de vereniging te halen.
            </p>
        @show
        </div>
    </div>
@stop