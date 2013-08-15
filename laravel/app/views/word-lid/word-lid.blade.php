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
            <ul class="secondary-menu">
                <li><a href="#">Waarom lid worden?</a></li>
                <li><a href="#">Zus en zo?</a></li>
                <li><a href="#">Bla die bla?</a></li>
            </ul>
        </div>
    </div>
    <div class="hero-unit grey">
        <form class="form-horizontal">
            <div class="column-holder" role="main">
                <h1>Meld je aan!</h1>
                <div class="delta">Door onderstaand formulier in te vullen meld je je aan voor de Gereformeerde Studentenvereniging Groningen</div>
                <div class="main-content">
                    <div class="form-group">
                        <label class="control-label" for="inputImage">Upload een foto van jezelf</label>
                        <input type="file" name="inputImage" id="inputImage" accept="image/*" capture="camera">
                    </div>
                    <div class="form-group has-error">
                        <label class="control-label" for="inputVoornaam">Voornaam</label>
                        <input type="text" class="form-control" id="inputVoornaam" name="inputVoornaam" placeholder="Voornaam">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="inputAchternaam">Achternaam</label>
                        <input type="text" class="form-control" id="inputAchternaam" name="inputAchternaam" placeholder="Achternaam">
                    </div>
                </div>
                <div class="secondary-column">
                    <div id="preview-image">
                
                    </div>
                </div>
            </div>
            <div class="column-holder">
                <div class="control-group">
                    <input type="submit" value="Meld je aan" class="button">
                </div>
            </div>
        </form>
    </div>
@stop

@section('word-lid')
@stop

@section('javascripts')
    @parent
    <script src="javascripts/word-lid.js"></script>
@stop