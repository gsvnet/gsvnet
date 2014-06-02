<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{{ $title or 'GSV' }}}</title>

    <meta name="description" content="{{{ $description or 'Gereformeerde Studenten Vereniging Groningen' }}}" />

    <link rel="shortcut icon" href="/favicon.png" />

    <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans:400,700|PT+Serif:400,700,400italic">

    @section('stylesheets')
        <!-- Stylesheets -->
        <link rel="stylesheet" href="/stylesheets/screen.css">
    @show
</head>
<body id="{{{ $bodyID or '' }}}">
    <div class="overal-header">
        @include('layouts.header')
        @yield('top-slideshow')
    </div>

    @yield('content')

    @section('word-lid')
        @if (Auth::guest() || !Auth::user()->wasOrIsMember())
        <div class="hero-unit purple">
            <p class="center"><a href="{{ URL::action('MemberController@becomeMember') }}" class="button">Word lid!</a></p>
        </div>
        @endif
    @show

    <footer class="site-footer column-holder">
        <p>Caput sapientiae est reverentia domini</p>
        <address class="address-info" itemscope itemtype="http://data-vocabulary.org/Organization">
            <p>
                <span itemprop="name"><a href="http://www.gsvnet.nl/" itemprop="url">Gereformeerde Studenten Vereniging</a></span>. 
                <span itemprop="address" itemscope itemtype="http://data-vocabulary.org/Address">
                    <span itemprop="street-address">Hereweg 40</span>, 
                    <span itemprop="locality">Groningen</span>.
                    <meta itemprop="region" content="Groningen" />
                    <meta itemprop="country-name" content="Nederland" />
                </span>
                <a href="/de-gsv/contact" title="Contact">Contactgegevens</a>
            </p>
            <meta itemprop="latitude" content="53.2093731" />
            <meta itemprop="longitude" content="6.5723083" />
            <p></p>
        </address>
    </footer>

    @if (Auth::guest())
        @include('login-dialog')
    @endif

    @section('javascripts')
        <script async src="/build-javascripts/app.js"></script>
    @show
</body>
</html>