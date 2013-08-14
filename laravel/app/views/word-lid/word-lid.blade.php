@section('header')
    @parent

    <section class="slideshow-wrap">
        <div class="slideshow">
            <div href="#" class="slide">
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
        <div class="slideshow-spacer"></div>
    </section>

@stop

@section('content')
    <div class="column-holder" role="main">
        <p class="delta">Wil jij een onvergetelijke studententijd?</p>
        <div class="main-content">
            <p>De GSV is de meest hechte christelijke studentenvereniging van Groningen. 
            Onze vereniging biedt de perfecte combinatie van christelijke waarden en het echte studentenleven.</p>
            <p>Je voelt je bij ons snel thuis te midden van actieve en betrokken medestudenten. 
            Wil jij een vereniging waar het geloof een centrale rol speelt, een vereniging met vele toffe, diverse activiteiten en weekenden en waar je vrienden voor het leven maakt? 
            Kortom: wil jij dit meemaken?</p>
        </div>
        <div class="secondary-column">
            <aside class="pull-quote">
                <blockquote>
                    <p>Zus en zo</p>
                </blockquote>
            </aside>
        </div>
    </div>
    <div class="hero-unit">
        <div class="column-holder" role="main">
            <h2>Meld je aan!</h2>
            <form class="form-horizontal">
                <div class="control-group">
                    <label class="control-label" for="input-voornaam">Voornaam</label>
                    <div class="controls">
                        <input type="text" id="input-voornaam" placeholder="Voornaam">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="input-achternaam">Achternaam</label>
                    <div class="controls">
                        <input type="password" id="input-achternaam" placeholder="Achternaam">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="input-email">E-mail</label>
                    <div class="controls">
                        <input type="password" id="input-email" placeholder="E-mail">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="input-telefoon">Telefoon</label>
                    <div class="controls">
                        <input type="password" id="input-telefoon" placeholder="Telefoon">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="input-rug">RuG-nummer</label>
                    <div class="controls">
                        <input type="password" id="input-rug" placeholder="S.......">
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('word-lid')
@stop