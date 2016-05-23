@extends('layouts.default')

@section('title', 'Pijlers')
@section('description', 'De GSV kent vier pijlers: christelijk, intellectueel, sociaal en studentikoos.')
@section('body-id', 'pillars-page')

@section('content')

    <article class="artikel column-holder" role="main">
        <div>
            <h1>Pijlers</h1>
            <p class="lead">De GSV richt haar activiteiten in volgens vier pijlers. Een christelijke, een intellectuele, een sociale en een studentikoze pijler. Hier onder volgt een korte uitleg over wat de pijlers inhouden</p>
        </div>

        <h2 id="christelijk">De christelijke pijler</h2>
        <div class="i-christian icon"></div>
        <p>De christelijke pijler is de belangrijkste pijler van de vereniging. Elke week op dinsdagavond is er de kernactiviteit van de vereniging: bijbelkring. Op deze avonden gaat het over de meest uiteenlopende onderwerpen zoals een bijbelboek, een actueel onderwerp of de themabijbelstudie die wordt gemaakt door leden van de vereniging en die op hetzelfde moment met alle kringen behandeld wordt. </p>

        <div id="christelijk-slideshow" class="carousel slide article-slideshow">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#christelijk-slideshow" data-slide-to="0" class="active"></li>
                <li data-target="#christelijk-slideshow" data-slide-to="1"></li>
                <li data-target="#christelijk-slideshow" data-slide-to="2"></li>
                <li data-target="#christelijk-slideshow" data-slide-to="3"></li>
                <li data-target="#christelijk-slideshow" data-slide-to="4"></li>
                <li data-target="#christelijk-slideshow" data-slide-to="5"></li>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <img width="960" height="640" src="/images/over/christelijk-1.jpg" alt="Bezinningsweekend">
                    <div class="carousel-caption">
                        Bezinningsweekend
                    </div>
                </div>
                <div class="item">
                    <img width="960" height="640" src="/images/over/christelijk-2.jpg" alt="Diesconcert">
                    <div class="carousel-caption">
                       
                    </div>
                </div>
                <div class="item">
                    <img width="960" height="640" src="/images/over/christelijk-3.jpg" alt="Bezinningsweekend">
                    <div class="carousel-caption">
                        Bezinningsweekend
                    </div>
                </div>
                <div class="item">
                    <img width="960" height="640" src="/images/over/christelijk-6.jpg" alt="Bezinningsweekend">
                    <div class="carousel-caption">
                        Bezinningsweekend
                    </div>
                </div>
                <div class="item">
                    <img width="960" height="640" src="/images/over/christelijk-7.jpg" alt="Bezinningsweekend">
                    <div class="carousel-caption">
                        Bezinningsweekend
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#christelijk-slideshow" data-slide="prev">
                <span class="i-back icon-prev"></span>
            </a>
            <a class="right carousel-control" href="#christelijk-slideshow" data-slide="next">
                <span class="i-forward icon-next"></span>
            </a>
        </div>
        <p>Maar dat is niet het enige. De vereniging heeft door het jaar heen verschillende sing-ins, op soos of tijdens een lekker ontbijt, en er zijn speciale bijeenkomsten tijdens Kerst en Pasen. Ook is er één verenigingsbreed bezinningsweekend. Tijdens dit weekend wordt er gediscussieerd, gezongen, geluisterd naar sprekers, maar ook is er tijd voor spelletjes of een biertje. Op de GSV is altijd ruimte voor een goed gesprek over het geloof of een uitdagende discussie. De vereniging is open voor alle christenen en ook open voor alle vragen over het geloof. </p>

        <h2 id="intellectueel">Intellectuele pijler</h2>
        <div class="i-intellectual icon"></div>

        <p>Omdat we een academische vereniging zijn is er op de GSV ook ruimte voor verdiepende activiteiten. Door het jaar heen zijn er lezingen over de meest uiteenlopende onderwerpen; bijvoorbeeld een (christelijk) wetenschappelijk thema of over iets uit het bedrijfsleven. Ook zijn er drie avonden per jaar waarop GSV’ers elkaar bijvoorbeeld wat bijbrengen over hun studie of waar ze wat vertellen over hun scriptie of buitenlandreis. Ook culturele filmavondjes, discussieavonden of een pubquiz behoren tot de activiteiten in de intellectuele pijler.</p>

        <div id="intellectueel-slideshow" class="carousel slide article-slideshow">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#intellectueel-slideshow" data-slide-to="0" class="active"></li>
                <li data-target="#intellectueel-slideshow" data-slide-to="1"></li>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <img width="960" height="640" src="/images/over/intellectueel-1.jpg" alt="Lezing 'De Onlogische God' door J.A. Riemersma">
                    <div class="carousel-caption">
                        Lezing 'De Onlogische God' door J.A. Riemersma
                    </div>
                </div>
                 <div class="item">
                    <img width="960" height="640" src="/images/over/intellectueel-2.jpg" alt="Dispuut">
                    <div class="carousel-caption">
                        Dispuut
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#intellectueel-slideshow" data-slide="prev">
                <span class="i-back icon-prev"></span>
            </a>
            <a class="right carousel-control" href="#intellectueel-slideshow" data-slide="next">
                <span class="i-forward icon-next"></span>
            </a>
        </div>

        <p>Maar de GSV is meer dan alleen de activiteiten. Bij de GSV zul je een groep mensen treffen die als studenten elkaar motiveert om te studeren, of juist afspreekt om nu en dan even pauze te houden in de kantine van de Universiteitsbibliotheek. Kritische geluiden worden altijd gewaardeerd op de vereniging en voor een goed gesprek of een goede discussie zijn veel leden zeker wel warm te krijgen.</p>

        <h2 id="sociaal">Sociale pijler</h2>
        <div class="i-social icon"></div>
        <p>Alle activiteiten van de GSV zijn natuurlijk sociale activiteiten en de sociale pijler is dan ook heel belangrijk voor de vereniging. Als eerste is er standaard als kernactiviteit op donderdag soos waar je in de eerste plaats je verenigingsgenoten ontmoet, maar waar je ook andere (studie)vrienden mee naar toe kunt nemen. Daarnaast valt er genoeg te borrelen met je bijbelkring, je regio (vaste groepen van vier à vijf bijbelkringen) of op een van de vele weekenden met de GSV.</p>

        <div id="sociaal-slideshow" class="carousel slide article-slideshow">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#sociaal-slideshow" data-slide-to="0" class="active"></li>
                <li data-target="#sociaal-slideshow" data-slide-to="1"></li>
                <li data-target="#sociaal-slideshow" data-slide-to="2"></li>
                <li data-target="#sociaal-slideshow" data-slide-to="3"></li>
                <li data-target="#sociaal-slideshow" data-slide-to="4"></li>
                                
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <img width="960" height="640" src="/images/over/sociaal-1.jpg" alt="Sociëteit &mdash; voorzaal">
                    <div class="carousel-caption">
                        Sociëteit &mdash; voorzaal
                    </div>
                </div>
                <div class="item">
                   <img width="960" height="640" src="/images/over/sociaal-2.jpg" alt="Sociëteit &mdash; achterzaal">
                    <div class="carousel-caption">
                        Sociëteit &mdash; achterzaal
                    </div>
                </div>
                <!--
                <div class="item">
                   <img width="960" height="640" src="/images/over/sociaal-3.jpg" alt="Spelletjesavond">
                    <div class="carousel-caption">
                        Spelletjesavond
                    </div>
                </div>
                -->
                <div class="item">
                   <img width="960" height="640" src="/images/over/sociaal-4.jpg" alt="Sociëteit &mdash; voorzaal">
                    <div class="carousel-caption">
                        Sociëteit &mdash; voorzaal
                    </div>
                </div>
                <div class="item">
                   <img width="960" height="640" src="/images/over/sociaal-5.jpg" alt="Sociëteit &mdash; achterzaal">
                    <div class="carousel-caption">
                        Sociëteit &mdash; achterzaal
                    </div>
                </div>
                 <div class="item">
                   <img width="960" height="640" src="/images/over/sociaal-6.jpg" alt="Sociëteit &mdash; achterzaal">
                    <div class="carousel-caption">
                        Sociëteit &mdash; achterzaal
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#sociaal-slideshow" data-slide="prev">
                <span class="i-back icon-prev"></span>
            </a>
            <a class="right carousel-control" href="#sociaal-slideshow" data-slide="next">
                <span class="i-forward icon-next"></span>
            </a>
        </div>

        <p>De GSV staat bekend om haar leuke en vele feestjes, maar de GSV is veel meer dan dat. De GSV is een groep mensen die je na een jaar goed kent en waar je vrienden voor het leven maakt. Op de GSV hoor je bij een groep mensen waarmee je gaat eten, gaat stappen, gaat hardlopen, fietsen en voetballen en muziek maken, kortom de GSV is een plek waar iedereen zich thuis kan voelen.</p>

        <h2 id="studentikoos">Studentikoze pijler</h2>
        <div class="i-collegiate icon"></div>
        <p>Bij een studentenvereniging hoort studentikoziteit. Dit wordt door veel leden gewaardeerd en het kenmerkt de GSV met haar lange tradities en gewoontes als een echte studentenvereniging. De mores van onze vereniging worden bewaard door de Magister Morum en ze worden ons voorgespiegeld door de Monarch. Daarnaast is er een College dat uitspraken doet in verenigingszaken en voorlichting geeft over de juiste studentikoze leefregels van de vereniging.</p>

        <div id="studentikoos-slideshow" class="carousel slide article-slideshow">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#studentikoos-slideshow" data-slide-to="0" class="active"></li>
                <li data-target="#studentikoos-slideshow" data-slide-to="1"></li>
                <li data-target="#studentikoos-slideshow" data-slide-to="2"></li>
                <li data-target="#studentikoos-slideshow" data-slide-to="3"></li>
                <li data-target="#studentikoos-slideshow" data-slide-to="4"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <img width="960" height="640" src="/images/over/studentikoos-1.jpg" alt="Dies Natalis">
                    <div class="carousel-caption">
                        Dies Natalis
                    </div>
                </div>
                    <div class="item">
                    <img width="960" height="640" src="/images/over/studentikoos-4.jpg" alt="Dies Natalis">
                    <div class="carousel-caption">
                        Dies Natalis
                    </div>
                </div>
                <div class="item">
                    <img width="960" height="640" src="/images/over/studentikoos-2.jpg" alt="Dies Natalis: jaarverbandsfoto">
                    <div class="carousel-caption">
                        Dies Natalis: jaarverbandsfoto
                    </div>
                </div>
                <div class="item">
                    <img width="960" height="640" src="/images/over/studentikoos-3.jpg" alt="Academiegebouw: jaarverbandsfoto">
                    <div class="carousel-caption">
                        Academiegebouw: jaarverbandsfoto
                    </div>
                </div>
                <div class="item">
                    <img width="960" height="640" src="/images/over/studentikoos-5.jpg" alt="Dies Natalis">
                    <div class="carousel-caption">
                        Dies Natalis
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#studentikoos-slideshow" data-slide="prev">
                <span class="i-back icon-prev"></span>
            </a>
            <a class="right carousel-control" href="#studentikoos-slideshow" data-slide="next">
                <span class="i-forward icon-next"></span>
            </a>
        </div>

        <p>Het Studentikoze karakter van de vereniging werkt door in verschillende activiteiten. Ten eerste hebben we een novitiaat, een ontgroeningsperiode die alle leden doorlopen en waar studentikoziteit een belangrijke rol speelt. Daarnaast zijn er tal van tradities, hoogwaardigheidsbekleders, liederen en gebruiken die elk lid van de GSV kent. Er is elk jaar een Dies Natalis, een gala ter ere van de verjaardag van de GSV en ook de barspeeches, Huishoudelijke Vergaderingen en verenigingskleding dragen bij aan een studentikoze uitstraling.</p>



    </article>
@stop