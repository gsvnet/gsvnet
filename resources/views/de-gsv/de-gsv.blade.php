@extends('layouts.default')

@section('title', 'Over de GSV')
@section('description', 'De GSV is een christelijke studentenvereniging met een gereformeerde basis. Ze heeft zo\'n 200 leden die wekelijks bijeen komen voor bijbelstudie een biertje op soos.')
@section('body-id', 'about-page')

@section('content')

    <article class="artikel column-holder" role="main">
        <div>
            <h1>Over de GSV</h1>
            <p class="lead">De Gereformeerde Studentenvereniging, de GSV, is een christelijke studentenvereniging met een gereformeerde basis. De vereniging bestaat uit een hechte groep van zo&rsquo;n 200 studenten die elke week bij elkaar komen in bijbelkringen voor Bijbelstudie, maar ook voor een biertje op soos. Er worden veel activiteiten georganiseerd die passen bij een van de vijf pijlers die de GSV karakteriseren: de christelijke, de intellectuele, de sociale, de sportieve en de studentikoze pijler.</p>
        </div>

        <aside class="note">
            <b>Elkaar steunen</b> in het dienen van de Here, met name in de studie.
        </aside>
        <p>Al meer dan 50 jaar is de GSV één van de meest hechte verenigingen van Groningen. De vereniging met gereformeerde grondslag heeft als doel: ‘elkaar steunen in het dienen van de Here, met name in de studie.’ De GSV is veelzijdig en weet zich op verschillende manieren te uiten. Zo houden we bijbelkring en sing-ins om ons geloof te uiten en samen christen te zijn, maar worden er door het jaar heen ook lezingen en andere studiegerelateerde activiteiten georganiseerd. Daarnaast ontmoeten we elkaar elke donderdagavond op onze soos aan de Hereweg 40 en houden we van een goed feestje.</p>

        <div id="about-slideshow" class="carousel slide article-slideshow">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#about-slideshow" data-slide-to="0" class="active"></li>
                <li data-target="#about-slideshow" data-slide-to="1"></li>
                <li data-target="#about-slideshow" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <img src="images/GSV.png" alt="De GSV" width="960" height="640">
                    <div class="carousel-caption">
                    De GSV
                    </div>
                </div>
                <div class="item">
                    <img src="images/Dies.png" alt="Dies Natalis" width="960" height="640">
                    <div class="carousel-caption">
                    Dies Natalis
                    </div>
                </div>
                <div class="item">
                    <img src="data:image/png;base64,{{ $mapImage }}" alt="Adres sociëteit" width="960" height="640">
                    <div class="carousel-caption">
                    Sociëteit bij Hereweg 40 in Groningen
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#about-slideshow" data-slide="prev">
                <span class="i-back icon-prev"></span>
            </a>
            <a class="right carousel-control" href="#about-slideshow" data-slide="next">
                <span class="i-forward icon-next"></span>
            </a>
        </div>

        <p>Hoewel de vereniging vanuit een gereformeerd vrijgemaakte traditie is opgericht, staat zij open voor alle christenen die het eens kunnen zijn met de gereformeerde basis en grondbeginselen. Zo verwelkomt de vereniging elk jaar rond de 40 nieuwe leden, die meteen een goed begin van hun studententijd hebben bij de GSV. Van oorsprong is de GSV een academische vereniging, maar sinds  de fusie met GHBOV Ad Tempus Vitae staat zij ook open voor hbo-studenten. Het studentikoze karakter van de GSV komt naar voren in huishoudelijke vergaderingen en jarenlange tradities.</p>
    </article>
@stop
