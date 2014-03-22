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
                    <div id="homepage-video-slide" href="#" class="item active">

                        <div class="slider-video-wrap">
                            <video id="home-video" class="slider-video" preload="metadata">
                                <source src="videos/big_buck_bunny.mp4" type="video/mp4">
                                <source src="videos/big_buck_bunny.webm" type="video/webm">
                                <source src="videos/big_buck_bunny.ogv" type="video/ogg">
                            </video>
                        </div>

                        <a href="#" id="play-video-link" class="play-video" title="Speel de film">
                            <span class="shadow"></span>
                            <div class="video-button"></div>
                            <span data-picture data-alt="Een geweldig plaatje">
                                <span data-src="/images/banner/nogeen-480.jpg"></span>
                                <span data-src="/images/banner/nogeen-600.jpg" data-media="(min-width: 480px)"></span>
                                <span data-src="/images/banner/nogeen-1024.jpg" data-media="(min-width: 600px)"></span>
                                <span data-src="/images/banner/nogeen-1600.jpg" data-media="(min-width: 1024px)"></span>
                                <noscript>
                                    <img src="/images/banner/nogeen-480.jpg" alt="Geweldig plaatje" width="480" height="360">
                                </noscript>
                            </span>
                        </a>

                        
                        <div class="slide-description-wrapper">
                            <div class="slide-description">
                                <div class="slide-description-box">
                                    <p class="slide-title">Bekijk de film</p>
                                    <p class="slide-description-text">En hier wat!</p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div href="#" class="item">
                        <div class="slide-description-wrapper">
                            <div class="slide-description">
                                <div class="slide-description-box">
                                    <p class="slide-title">Hier wat leuks!</p>
                                    <p class="slide-description-text">En hier wat!</p>
                                </div>
                            </div>
                        </div>
                        <span data-picture data-alt="Een geweldig plaatje">
                            <span data-src="/images/banner/meisje-480.jpg"></span>
                            <span data-src="/images/banner/meisje-600.jpg" data-media="(min-width: 480px)"></span>
                            <span data-src="/images/banner/meisje-1024.jpg" data-media="(min-width: 600px)"></span>
                            <span data-src="/images/banner/meisje-1600.jpg" data-media="(min-width: 1024px)"></span>
                            <noscript>
                                <img src="/images/banner/meisje-480.jpg" alt="Geweldig plaatje" width="480" height="360">
                            </noscript>
                        </span>
                    </div>
                    <div href="#" class="item">
                        <div class="slide-description-wrapper">
                            <div class="slide-description">
                                <div class="slide-description-box">
                                    <p class="slide-title">Hier wat leuks!</p>
                                    <p class="slide-description-text">En hier wat!</p>
                                </div>
                            </div>
                        </div>
                        <span data-picture data-alt="Een geweldig plaatje">
                            <span data-src="/images/banner/mensen-480.jpg"></span>
                            <span data-src="/images/banner/mensen-600.jpg" data-media="(min-width: 480px)"></span>
                            <span data-src="/images/banner/mensen-1024.jpg" data-media="(min-width: 600px)"></span>
                            <span data-src="/images/banner/mensen-1600.jpg" data-media="(min-width: 1024px)"></span>
                            <noscript>
                                <img src="/images/nogeen-480.jpg" alt="Geweldig plaatje" width="480" height="360">
                            </noscript>
                        </span>
                    </div>
                    <div href="#" class="item">
                        <div class="slide-description-wrapper">
                            <div class="slide-description">
                                <div class="slide-description-box">
                                    <p class="slide-title">Hier wat leuks!</p>
                                    <p class="slide-description-text">En hier wat!</p>
                                </div>
                            </div>
                        </div>
                        <span data-picture data-alt="Een geweldig plaatje">
                            <span data-src="/images/banner/leuke-480.jpg"></span>
                            <span data-src="/images/banner/leuke-600.jpg" data-media="(min-width: 480px)"></span>
                            <span data-src="/images/banner/leuke-1024.jpg" data-media="(min-width: 600px)"></span>
                            <span data-src="/images/banner/leuke-1600.jpg" data-media="(min-width: 1024px)"></span>
                            <noscript>
                                <img src="/images/banner/leuke-480.jpg" alt="Geweldig plaatje" width="480" height="360">
                            </noscript>
                        </span>
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
    <div class="column-holder" role="main">
        <p class="delta">Denk je na over een actief studentenleven in Groningen? Dan ben je hier aan het juiste adres. De GSV is dé perfecte combinatie van christelijke waarden en het echte studentenleven.</p>
        <div class="main-content has-border-bottom">
            <p>Op deze site kun je meer lezen over de GSV en wat er allemaal valt te beleven bij onze studentenverenging. Wil je lid worden, of ben je gewoon nieuwsgierig? <a href="#" class="more">Klik dan snel hier</a></p>
            <h2>Over de GSV</h2>
            <p>De GSV, de Gereformeerde Studentenvereniging, is een christelijke studentenvereniging met een gereformeerde basis. De vereniging bestaat uit een hechte groep van zo’n 200 studenten die elke week bij elkaar komen op bijbelkring en tijdens soosavonden. </p>

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
                    @if(count($events) > 0)
                        <h2>Komende activiteiten</h2>
                        <ul class="unstyled-list title-description-list">
                        @foreach ($events as $event)
                            <li>
                                <span class="list-title">
                                {{ link_to_action('EventController@showEvent', $event->title, [$event->id])}}
                                </span>
                                <time class="list-description grey">{{ $event->from_to_short }}</time>
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
                                        @if (Permission::has('users.show'))
                                            {{ link_to_action('UserController@showUser', $profile->user->full_name, $profile->user->id) }}
                                        @else
                                            {{{ $profile->user->full_name }}}
                                        @endif
                                    </span>
                                    <time class="list-description grey">{{{ $profile->birthday }}}</time>
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
@stop