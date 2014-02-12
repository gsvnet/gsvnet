@section('header')
    @parent

    <section class="slideshow-wrap">
        <div id="carousel-example-generic" class="slideshow carousel slide">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div href="#" class="item active">
                    <div class="slide-description-wrapper">
                        <div class="slide-description">
                            <div class="slide-description-box">
                                <p class="delta">Hier wat leuks!</p>
                                <p>En hier wat!</p>
                            </div>
                        </div>
                    </div>
                    <img src="images/een-1600.jpg" alt="" class="slide-img"/>
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
                    <img src="images/een-1600.jpg" alt="" class="slide-img"/>
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
                    <img src="images/een-1600.jpg" alt="" class="slide-img"/>
                </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                <span class="icon-prev"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                <span class="icon-next"></span>
            </a>
        </div>
        <div class="slideshow-spacer"></div>
    </section>

@stop

@section('content')
    <div class="column-holder" role="main">
        <p class="delta">{{Auth::check() ? Auth::user()->firstname . ', w' : 'W'}}il jij een onvergetelijke studententijd?</p>
        <div class="main-content">
            <p>De GSV is de meest hechte christelijke studentenvereniging van Groningen. 
            Onze vereniging biedt de perfecte combinatie van christelijke waarden en het echte studentenleven.</p>
            <p>Je voelt je bij ons snel thuis te midden van actieve en betrokken medestudenten. 
            Wil jij een vereniging waar het geloof een centrale rol speelt, een vereniging met vele toffe, diverse activiteiten en weekenden en waar je vrienden voor het leven maakt? 
            Kortom: wil jij dit meemaken?</p>
        </div>
        <div class="secondary-column">
            <ul class="secondary-menu">
                <li><a href="#">Waarom lid worden?</a></li>
                <li><a href="#">Zus en zo?</a></li>
                <li><a href="#">Bla die bla?</a></li>
            </ul>
        </div>
    </div>
    <div class="hero-unit grey">
        @if(Auth::check())
            @include('word-lid.become-member')
        @else
            @include('word-lid.login-or-register')
        @endif
    </div>
@stop

@section('word-lid')
@stop