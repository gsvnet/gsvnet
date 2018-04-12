@extends('layouts.default')

@section('title', 'Gereformeerde Studenten Vereniging te Groningen')
@section('description', 'Denk je na over een actief studentenleven in Groningen? Dan ben je hier aan het juiste adres. De GSV is dé perfecte combinatie van christelijke waarden en het echte studentenleven.')
@section('body-id', 'home-page')

@section('top-slideshow')
    <section class="slideshow-wrap top-slideshow">
        <div id="homepage-carousel" class="slideshow carousel slide">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#homepage-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#homepage-carousel" data-slide-to="1"></li>
                <li data-target="#homepage-carousel" data-slide-to="2"></li>
                <li data-target="#homepage-carousel" data-slide-to="3"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-make-height">
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="/images/banner/sociaal-1600_mini.jpg" srcset="/images/banner/sociaal-600_mini.jpg 600w, /images/banner/sociaal-1024_mini.jpg 1024w, /images/banner/sociaal-1600_mini.jpg 1600w" alt="Sociaal"/>
                        <div class="slide-description-wrapper">
                            <div class="slide-description">
                                <div class="slide-description-box">
                                    <p class="slide-title">Sociaal</p>
                                    <p class="slide-description-text">Elke donderdag soos. Weekendjes weg. Goede feesten.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <img src="/images/banner/christelijk-1600_mini.jpg" srcset="/images/banner/christelijk-600_mini.jpg 600w, /images/banner/christelijk-1024_mini.jpg 1024w, /images/banner/christelijk-1600_mini.jpg 1600w" alt="Christelijke Studentenvereniging Groningen"/>
                        <div class="slide-description-wrapper">
                            <div class="slide-description">
                                <div class="slide-description-box">
                                    <p class="slide-title">Christelijk</p>
                                    <p class="slide-description-text">Elke dinsdag Bijbelkring. Sing-ins. Bezinningsweekend.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <img src="/images/banner/studentikoos-1600_mini.jpg" srcset="/images/banner/studentikoos-600_mini.jpg 600w, /images/banner/studentikoos-1024_mini.jpg 1024w, /images/banner/studentikoos-1600_mini.jpg 1600w" alt="Studentikoze Studentenvereniging"/>
                        <div class="slide-description-wrapper">
                            <div class="slide-description">
                                <div class="slide-description-box">
                                    <p class="slide-title">Studentikoos</p>
                                    <p class="slide-description-text">Bijna 50 jaar oude tradities. Dies Natalis. Mores. Keiharde feesten.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <img src="/images/banner/intellectueel-1600_mini.jpg" srcset="/images/banner/intellectueel-600_mini.jpg 600w, /images/banner/intellectueel-1024_mini.jpg 1024w, /images/banner/intellectueel-1600_mini.jpg 1600w" alt="Intellectuele Studentenvereniging"/>
                        <div class="slide-description-wrapper">
                            <div class="slide-description">
                                <div class="slide-description-box">
                                    <p class="slide-title">Intellectueel</p>
                                    <p class="slide-description-text">Academische vereniging. Lezingen. Goede discussies.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Controls -->
            <a class="left carousel-control" href="#homepage-carousel" data-slide="prev">
                <span class="i-back icon-prev"></span>
            </a>
            <a class="right carousel-control" href="#homepage-carousel" data-slide="next">
                <span class="i-forward icon-next"></span>
            </a>
        </div>
        <div class="slideshow-spacer"></div>
    </section>

@stop

@section('content')
    <div id="newsOverlay" class="hidden" onclick="(function(e, obj){if( e.target != obj ) return false;$(obj).hide();})(event, this)">
        <div id="newsPopup">
            <a href="#" class="close-button" onclick="$('#newsOverlay').hide()" class="button">x</a>
            <iframe src="https://player.vimeo.com/video/261181688" width="640" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            <p><b>BREAKING NEWS</b>: De GSV gaat samen met ATV! Met overweldigende meerderheid is besloten dat we vanaf juni samen verder zullen gaan onder de naam van de GSV. Het is een ontzettend gave stap en we hebben enorm veel zin in de komende tijd! Dit betekent ook dat vanaf komende zomer hbo-studenten lid kunnen worden bij de GSV. Op de hoogte blijven? Volg ons online: <a href="https://www.instagram.com/gsvgroningen">www.instagram.com/gsvgroningen</a> en <a href="https://www.facebook.com/GSVgroningen/">www.facebook.com/GSVgroningen</a>.</p>
            <div style="text-align:center;">
                <button class="close-button2" onclick="$('#newsOverlay').hide()">Sluiten</button>
            </div>
        </div>
    </div>

    <div class="column-holder" role="main">
        <p class="delta">Denk je na over een actief studentenleven in Groningen? Dan ben je hier aan het juiste adres. De GSV is dé perfecte combinatie van christelijke waarden en het echte studentenleven.</p>
        <div class="main-content has-border-bottom">
            <p>Op deze site kun je meer lezen over de GSV en wat er allemaal valt te beleven bij onze studentenverenging. Wil je lid worden, of ben je gewoon nieuwsgierig? <a href="/word-lid" class="more" title="Lid worden">Lees wat je moet weten</a></p>

            <h2>Over de GSV</h2>
            <p>De GSV, de Gereformeerde Studenten Vereniging, is een christelijke studentenvereniging met een gereformeerde basis. De vereniging bestaat uit een hechte groep van zo’n 200 studenten die elke week bij elkaar komen op bijbelkring en tijdens soosavonden. </p>

            <div class="content-columns">
                <div class="content-column">
                    <a href="/de-gsv/pijlers#christelijk" class="block-link">
                        <h3>Christelijk</h3>
                        <div class="icon i-christian"></div>
                        <p>De belangrijkste pijler van de vereniging is de christelijke pijler. Op de GSV speelt het christelijk geloof en christelijke verdieping een centrale rol. </p>
                    </a>
                </div>
                <div class="content-column">
                    <a href="/de-gsv/pijlers#sociaal" class="block-link">
                        <h3>Sociaal</h3>
                        <div class="icon i-social"></div>
                        <p>Een studentenvereniging is er natuurlijk voor de gezelligheid. Alleen al op onze Sociëteit kun je elkaar elke donderdagavond ontmoeten om een biertje te drinken.</p>
                    </a>
                </div>
            </div>
            <div class="content-columns">
                <div class="content-column">
                    <a href="/de-gsv/pijlers#intellectueel" class="block-link">
                        <h3>Intellectueel</h3>
                        <div class="icon i-intellectual"></div>
                        <p>Als academische vereniging is intellectualiteit belangrijk binnen de vereniging. Het is leuk om elkaar uit te dagen kritisch na te denken over wetenschap, maar ook het geloof.</p>
                    </a>
                </div>
                <div class="content-column">
                    <a href="/de-gsv/pijlers#studentikoos" class="block-link">
                        <h3>Studentikoos</h3>
                        <div class="icon i-collegiate"></div>
                        <p>Een studentenverenging is geen studentenvereniging zonder een goede dosis studentikoziteit. Ook de GSV kent haar eigen mores en lange tradities die zij met verve hoog houdt. </p>
                    </a>
                </div>
            </div>
        </div>
        <div class="secondary-column">
            <div class="content-columns">
                <div class="content-column">
                    <h2>Word lid</h2>
                    <p><a href="/word-lid/inschrijven" class="button" title="Meld je aan">Meld je aan!</a></p>

                    @if(count($events) > 0)
                        <h2>Komende activiteiten</h2>
                        <ul class="unstyled-list title-description-list">
                        @foreach ($events as $event)
                            <li>
                                <span class="list-title">
                                {!! HTML::link($event->present()->url, $event->title) !!}
                                </span>
                                <time class="list-description grey">{{ $event->present()->from_to_short }}</time>
                            </li>
                        @endforeach
                        </ul>
                    @endif
                </div>
                <div class="content-column">
                    <h2>Verjaardagen</h2>
                    <ul class="unstyled-list title-description-list">
                        @if ($birthdays->count())
                            @foreach ($birthdays as $profile)
                                <li>
                                    <span class="list-title">
                                        @can('users.show')
                                            {!! link_to_action('UserController@showUser', $profile->user->present()->fullName, $profile->user->id) !!}
                                        @else
                                            {{ $profile->user->present()->fullName }}
                                        @endcan
                                    </span>
                                    <time class="list-description grey">{{ $profile->present()->birthday }}</time>
                                </li>
                            @endforeach
                        @else
                            <li>Geen verjaardagen deze week.</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @include('partials/_directads')
@stop
