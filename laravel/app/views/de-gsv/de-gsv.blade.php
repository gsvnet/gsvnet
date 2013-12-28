@section('content')

    <article class="artikel column-holder" role="main">
        <div>
            <h1>Over de GSV</h1>
            <p class="lead">De Gereformeerde Studentenvereniging, de GSV, is een christelijke studentenvereniging met een gereformeerde basis. De vereniging bestaat uit een hechte groep van zo&rsquo;n 200 studenten die elke week bij elkaar komen in bijbelkringen voor Bijbelstudie, maar ook voor een biertje op soos. Binnen de vereniging worden veel activiteiten georganiseerd die passen bij een van de vier pijlers die de GSV karakteriseren: de christelijke, de intellectuele, de sociale en de studentikoze pijler.</p>
        </div>

        <ul class="secondary-menu">
            <li><a href="#">Waarom lid worden?</a></li>
            <li><a href="#">Zus en zo?</a></li>
            <li><a href="#">Bla die bla?</a></li>
            <li><a href="{{ URL::route('about_committees') }}">Commissies</a></li>
        </ul>

        <p>De GSV is opgericht in 1966 en is al zo’n goed 50 jaar d&eacute; academische vereniging met gereformeerde grondslag in Groningen. Als doelstelling heeft de vereniging: &ldquo;elkaar steunen in het dienen van de Here, met name in de studie.&rdquo;</p>

        <p>Dit uit zich in de vele verschillende aspecten van de vereniging. We houden bijvoorbeeld bijbelkring en sing-ins om zo God te dienen en samen christen te zijn, maar ook zijn er door het jaar heen lezingen en studiegerelateerde avonden die ook de ruimte bieden voor discussie en verdieping. Het sociale aspect van de vereniging komt naar voren, in het elkaar leren kennen en ontmoeten op soosavonden en feestjes. Het doel van de vereniging is om de Heer te dienen in de academische wereld en elkaar te steunen in het zijn van christen binnen de universiteit. </p>

        <div id="about-slideshow" class="carousel slide article-slideshow">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <img src="images/foto.jpg" alt="...">
                    <div class="carousel-caption">
                    Mountainbiken
                    </div>
                </div>
                <div class="item">
                    <img src="images/foto2.jpg" alt="...">
                    <div class="carousel-caption">
                    Nog iets
                    </div>
                </div>
                <div class="item">
                    <img src="images/foto.jpg" alt="...">
                    <div class="carousel-caption">
                    Opnieuw
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#about-slideshow" data-slide="prev">
                <span class="icon-prev"></span>
            </a>
            <a class="right carousel-control" href="#about-slideshow" data-slide="next">
                <span class="icon-next"></span>
            </a>
        </div>

        <p>Hoewel de vereniging vanuit een Gereformeerd vrijgemaakte traditie is opgericht, staat zij open voor alle christenen die het eens kunnen zijn met de gereformeerde basis en grondbeginselen. Zo verwelkomt de vereniging elk jaar rond de 40 nieuwe leden, die meteen een goed begin van hun studententijd hebben bij de GSV. De GSV is naast een gereformeerde ook een academische vereniging. Dit betekent dat alleen universitaire studenten lid kunnen worden van de vereniging. Dit geeft de vereniging haar eigen studentikoze maar ook verdiepende karakter.</p>
        <aside class="note">
            <b>Elkaar steunen</b> in het dienen van de Here, met name in de studie.
        </aside>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim itaque animi numquam similique perspiciatis dicta beatae corrupti eum deleniti ad! Veniam, adipisci, dolorem, voluptate tempore fugit id temporibus iure beatae vero rem cumque consequatur facilis nobis consequuntur magnam blanditiis aspernatur veritatis qui quod cupiditate harum placeat cum possimus officia animi culpa ex eligendi voluptatibus corporis ipsum neque explicabo mollitia officiis consectetur soluta iste maiores aut. Cupiditate, pariatur, animi perspiciatis expedita eos recusandae reiciendis sed in laboriosam officiis eius aut voluptatem!</p>
    </article>
@stop

@section('javascripts')
    @parent
    <script src="/javascripts/carousel.js"></script>
@stop