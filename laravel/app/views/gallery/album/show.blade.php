@section('content')
    <div class="column-holder" role="main">
        <h1>{{ $album->name }}</h1>
        <p class="delta">{{ $album->description }}</p>
        <div class="photos">
            <div class="photo-grid-row">
                <div class="photo-tile first">
                    <a href="http://lorempixel.com/800/600?a" class="photo-link" title="zus">
                        <img src="http://lorempixel.com/306/306?a" alt="zus" />
                        <p class="photo-description">GSV zus en zo</p>
                    </a>
                </div>
                <div class="photo-tile">
                    <a href="http://lorempixel.com/800/600?b" class="photo-link" title="zus">
                        <img src="http://lorempixel.com/306/306?b" alt="zus" />
                        <p class="photo-description">Zus en zo</p>
                    </a>
                </div>
                <div class="photo-tile">
                    <a href="http://lorempixel.com/800/600?c" class="photo-link" title="zus">
                        <img src="http://lorempixel.com/306/306?c" alt="zus" />
                        <p class="photo-description">Hier iets</p>
                    </a>
                </div>
            </div>
            <div class="photo-grid-row">
                <div class="photo-tile first wide">
                    <a href="http://lorempixel.com/800/600?d" class="photo-link" title="zus">
                        <img src="http://lorempixel.com/634/306?c" alt="zus" />
                        <p class="photo-description">aergaegr</p>
                    </a>
                </div>
                <div class="photo-tile">
                    <a href="http://lorempixel.com/800/600?e" class="photo-link" title="zus">
                        <img src="http://lorempixel.com/306/306?d" alt="zus" />
                        <p class="photo-description">GSV zus en zo</p>
                    </a>
                </div>
            </div>
            <div class="photo-grid-row">
                <div class="photo-tile first">
                    <a href="http://lorempixel.com/800/600?f" class="photo-link" title="zus">
                        <img src="http://lorempixel.com/306/306?e" alt="zus" />
                        <p class="photo-description">GSV zus en zo</p>
                    </a>
                </div>
                <div class="photo-tile">
                    <a href="http://lorempixel.com/800/600?g" class="photo-link" title="zus">
                        <img src="http://lorempixel.com/306/306?f" alt="zus" />
                        <p class="photo-description">Zus en zo</p>
                    </a>
                </div>
                <div class="photo-tile">
                    <a href="http://lorempixel.com/800/600?h" class="photo-link" title="zus">
                        <img src="http://lorempixel.com/306/306?g" alt="zus" />
                        <p class="photo-description">Hier iets</p>
                    </a>
                </div>
            </div>
            <div class="photo-grid-row">
                <div class="photo-tile first">
                    <a href="http://lorempixel.com/800/600?i" class="photo-link" title="zus">
                        <img src="http://lorempixel.com/306/306?h" alt="zus" />
                        <p class="photo-description">GSV zus en zo</p>
                    </a>
                </div>
                <div class="photo-tile wide">
                    <a href="http://lorempixel.com/800/600?j" class="photo-link" title="zus">
                        <img src="http://lorempixel.com/634/306?i" alt="zus" />
                        <p class="photo-description">GSV zus en zo</p>
                    </a>
                </div>
            </div>
        </div>

        {{ $photos->links() }}
    </div>
@stop

@section('javascripts')
    @parent
    <script src="/javascripts/fotos.js"></script>
@stop