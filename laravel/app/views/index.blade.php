@section('top-slideshow')
    <section class="slideshow-wrap top-slideshow">
        <div id="carousel-example-generic" class="slideshow carousel slide">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                <li data-target="#carousel-example-generic" data-slide-to="3"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <a href="#" class="item active">
                    <div class="slide-description-wrapper">
                        <div class="slide-description">
                            <div class="slide-description-box">
                                <p class="delta">Bekijk de film</p>
                                <p>En hier wat!</p>
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
                                <p class="delta">Hier wat leuks!</p>
                                <p>En hier wat!</p>
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
                                <p class="delta">Hier wat leuks!</p>
                                <p>En hier wat!</p>
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
                                <p class="delta">Hier wat leuks!</p>
                                <p>En hier wat!</p>
                            </div>
                        </div>
                    </div>
                    <span data-picture data-alt="Een geweldig plaatje">
                        <span data-src="/images/nogeen-480.jpg"></span>
                        <span data-src="/images/nogeen-600.jpg" data-media="(min-width: 480px)"></span>
                        <span data-src="/images/nogeen-1024.jpg" data-media="(min-width: 600px)"></span>
                        <span data-src="/images/nogeen-1600.jpg" data-media="(min-width: 1024px)"></span>
                        <noscript>
                            <img src="/images/nogeen-480.jpg" alt="Geweldig plaatje">
                        </noscript>
                    </span>
                </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                <span class="fa fa-arrow-left icon-prev"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                <span class="fa fa-arrow-right icon-next"></span>
            </a>
        </div>
        <div class="slideshow-spacer"></div>
    </section>

@stop

@section('content')
    <div class="column-holder" role="main">
        <p class="delta">Denk je na over een actief studentenleven in Groningen? Dan ben je hier aan het juiste adres. De GSV is dé studentenvereniging waar je verdieping vindt en uiteraard veel gezelligheid.</p>
        <div class="main-content">
            <p>Op deze site kun je meer lezen over de GSV en wat er allemaal valt te beleven bij onze studentenverenging. Wil je lid worden, of ben je gewoon nieuwsgierig? <a href="#" class="more">Klik dan snel hier</a></p>
            <h2>Over de GSV</h2>
            <p>De GSV, de Gereformeerde Studentenvereniging, is een christelijke studentenvereniging met een gereformeerde basis. De vereniging bestaat uit een hechte groep van zo’n 200 studenten die elke week bij elkaar komen op bijbelkring en tijdens soosavonden. </p>
        </div>
        <div class="secondary-column">
            <h2>Lorem ipsum dolor sit.</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa id aut voluptas eos sed vel blanditiis maiores sunt inventore nihil.</p>
            <h2>Lorem ipsum dolor sit.</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa id aut voluptas eos sed vel blanditiis maiores sunt inventore nihil.</p>
        </div>
    </div>
@stop

@section('javascripts')
    @parent

    <script src="/javascripts/carousel.js"></script>
    <script src="/javascripts/matchmedia.js"></script>
    <script src="/javascripts/picturefill.js"></script>
@stop