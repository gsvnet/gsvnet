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
            <div class="carousel-inner">
                <a href="#" class="item active">
                    <div class="slide-description-wrapper">
                        <div class="slide-description">
                            <div class="slide-description-box">
                                <p class="slide-title">Bekijk de film</p>
                                <p class="slide-description-text">En hier wat!</p>
                            </div>
                        </div>
                    </div>
                    <span class="shadow"></span>
                    <div class="video-button"></div>
                    <span data-picture data-alt="Een geweldig plaatje">
                        <span data-src="/images/nogeen-480.jpg"></span>
                        <span data-src="/images/nogeen-600.jpg" data-media="(min-width: 480px)"></span>
                        <span data-src="/images/nogeen-1024.jpg" data-media="(min-width: 600px)"></span>
                        <span data-src="/images/nogeen-1600.jpg" data-media="(min-width: 1024px)"></span>
                        <noscript>
                            <img src="/images/nogeen-480.jpg" alt="Geweldig plaatje">
                        </noscript>
                    </span>
                </a>
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
                            <img src="/images/banner/meisje-480.jpg" alt="Geweldig plaatje">
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
                            <img src="/images/nogeen-480.jpg" alt="Geweldig plaatje">
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
                            <img src="/images/banner/leuke-480.jpg" alt="Geweldig plaatje">
                        </noscript>
                    </span>
                </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#homepage-carousel" data-slide="prev">
                <span class="fa fa-arrow-left icon-prev"></span>
            </a>
            <a class="right carousel-control" href="#homepage-carousel" data-slide="next">
                <span class="fa fa-arrow-right icon-next"></span>
            </a>
        </div>
        <div class="slideshow-spacer"></div>
    </section>

@stop

@section('content')
    <div class="column-holder" role="main">
        <p class="delta">Denk je na over een actief studentenleven in Groningen? Dan ben je hier aan het juiste adres. De GSV is dé perfecte combinatie van christelijke waarden en het echte studentenleven.</p>
        <div class="main-content">
            <p>Op deze site kun je meer lezen over de GSV en wat er allemaal valt te beleven bij onze studentenverenging. Wil je lid worden, of ben je gewoon nieuwsgierig? <a href="#" class="more">Klik dan snel hier</a></p>
            <h2>Over de GSV</h2>
            <p>De GSV, de Gereformeerde Studentenvereniging, is een christelijke studentenvereniging met een gereformeerde basis. De vereniging bestaat uit een hechte groep van zo’n 200 studenten die elke week bij elkaar komen op bijbelkring en tijdens soosavonden. </p>

            <div class="content-columns">
                <div class="content-column">
                    <a href="#" class="block-link">
                        <h3>Christelijk</h3>
                        <div class="icon i-christian"></div>
                        <p>Als hier nou ieman wat schrijft dan zou dat fantastisch zijn.</p>
                    </a>
                </div>
                <div class="content-column">
                    <a href="#" class="block-link">
                        <h3>Sociaal</h3>
                        <div class="icon i-social"></div>
                        <p>Hier geldt eigenlijk precies hetzelfde voor, even kijken wat er gebeurt als ik de tekst wat langer maak zodat hij meerdere regels beslaat.</p>
                    </a>
                </div>
            </div>
            <div class="content-columns">
                <div class="content-column">
                    <a href="#" class="block-link">
                        <h3>Intellectueel</h3>
                        <div class="icon i-intellectual"></div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet cumque sapiente dolor corporis nam earum necessitatibus voluptatem! Placeat, expedita, qui ab et deleniti aut iste repellendus omnis pariatur perspiciatis unde.</p>
                    </a>
                </div>
                <div class="content-column">
                    <a href="#" class="block-link">
                        <h3>Studentikoos</h3>
                        <div class="icon i-collegiate"></div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse, dolor?</p>
                    </a>
                </div>
            </div>
        </div>
        <div class="secondary-column">
            @if(count($events) > 0)
                <h2>Komende activiteiten</h2>
                <ul class="unstyled-list small-event-list">
                @foreach ($events as $event)
                    <li>
                        <span class="list-title">
                        {{ link_to_action('EventController@showEvent', $event->title, [$event->id])}}
                        </span>
                        <time class="list-description">{{ $event->start_long }}</time>
                    </li>
                @endforeach
                </ul>
            @endif

            <h2>Verjaardagen</h2>
            <ul class="unstyled-list">
                @if ($birthdays->count())
                    @foreach ($birthdays as $profile)
                        <li>
                            <strong>
                            {{{ $profile->user->full_name }}}
                            </strong>
                            <br>
                            {{{ $profile->birthday }}}
                        </li>
                    @endforeach
                @else
                    <li>Geen verjaardagen deze week.</li>
                @endif
            </ul>
        </div>
    </div>
@stop