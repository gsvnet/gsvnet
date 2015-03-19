@extends('layouts.default')

@section('title', 'Over de GSV')
@section('description', 'De GSV is een christelijke studentenvereniging met een gereformeerde basis. Ze heeft zo\'n 200 leden die wekelijks bijeen komen voor bijbelstudie een biertje op soos.')
@section('body-id', 'about-page')

@section('content')

    <article class="artikel column-holder" role="main">
        <div>
            <h1>Over de GSV</h1>
            <p class="lead">De Gereformeerde Studentenvereniging, de GSV, is een christelijke studentenvereniging met een gereformeerde basis. De vereniging bestaat uit een hechte groep van zo&rsquo;n 200 studenten die elke week bij elkaar komen in bijbelkringen voor Bijbelstudie, maar ook voor een biertje op soos. Binnen de vereniging worden veel activiteiten georganiseerd die passen bij een van de vier pijlers die de GSV karakteriseren: de christelijke, de intellectuele, de sociale en de studentikoze pijler.</p>
        </div>

        <p>De Gereformeerde Studentenvereniging, de GSV, is een christelijke studentenvereniging met een gereformeerde basis. De vereniging bestaat uit een hechte groep van zo’n 200 studenten die elke week bij elkaar komen in bijbelkringen voor Bijbelstudie, maar ook voor een biertje op soos. Binnen de vereniging worden veel activiteiten georganiseerd die passen bij een van de vier pijlers die de GSV karakteriseren: de christelijke, de intellectuele, de sociale en de studentikoze pijler.</p>

        <p>De GSV is opgericht in 1966 en is al zo’n goed 50 jaar d&eacute; academische vereniging met gereformeerde grondslag in Groningen. Als doelstelling heeft de vereniging: &ldquo;elkaar steunen in het dienen van de Here, met name in de studie.&rdquo;</p>
        <aside class="note">
            <b>Elkaar steunen</b> in het dienen van de Here, met name in de studie.
        </aside>

        <p>Dit uit zich in de vele verschillende aspecten van de vereniging. We houden bijvoorbeeld bijbelkring en sing-ins om zo God te dienen en samen christen te zijn, maar ook zijn er door het jaar heen lezingen en studiegerelateerde avonden die ook de ruimte bieden voor discussie en verdieping. Het sociale aspect van de vereniging komt naar voren, in het elkaar leren kennen en ontmoeten op soosavonden en feestjes. Het doel van de vereniging is om de Heer te dienen in de academische wereld en elkaar te steunen in het zijn van christen binnen de universiteit. </p>

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
                    <img src="images/foto2.jpg" alt="De GSV" width="960" height="640">
                    <div class="carousel-caption">
                    De GSV
                    </div>
                </div>
                <div class="item">
                    <img src="images/foto.jpg" alt="Mountenbiken op zomerkamp" width="960" height="640">
                    <div class="carousel-caption">
                    Mountainbiken op zomerkamp
                    </div>
                </div>
                <div class="item">
                    <img src="http://maps.googleapis.com/maps/api/staticmap?center=Hereweg%2040,Groningen,Nederland&amp;size=480x320&amp;zoom=14&amp;sensor=false&amp;markers=color:purple%7Clabel:S%7CHereweg%2040,Groningen,Nederland&amp;key=***REMOVED***&amp;scale=2" alt="Adres sociëteit" width="960" height="640">
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

        <p>Hoewel de vereniging vanuit een Gereformeerd vrijgemaakte traditie is opgericht, staat zij open voor alle christenen die het eens kunnen zijn met de gereformeerde basis en grondbeginselen. Zo verwelkomt de vereniging elk jaar rond de 40 nieuwe leden, die meteen een goed begin van hun studententijd hebben bij de GSV. De GSV is naast een gereformeerde ook een academische vereniging. Dit betekent dat alleen universitaire studenten lid kunnen worden van de vereniging. Dit geeft de vereniging haar eigen studentikoze maar ook verdiepende karakter.</p>
    </article>
@stop