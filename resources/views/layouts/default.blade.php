<!doctype html>
<html lang="nl" prefix="og: http://ogp.me/ns#">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <meta name="description" content="@yield('description')" >
    <meta property="og:site_name" content="Gereformeerde Studenten Vereniging Groningen">
    <meta property="og:title" content="{{ $title or 'GSV' }}">
    <meta property="og:description" content="{{ !empty($description) ? $description : 'Gereformeerde Studenten Vereniging Groningen' }}">
    <meta property="og:url" content="{{Request::url()}}">
    <meta property="og:type" content="{{ Request::is('/') ? 'website' : 'article' }}">
    <meta property="og:image" content="http://gsvnet.nl/images/facebook.jpg">
    <meta property="og:image:type" content="image/jpg">
    <meta property="og:image:width" content="600">
    <meta property="og:image:height" content="400">

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="shortcut icon" sizes="57x57" href="//gsvnet.nl/images/app-icons/AppIcon57x57.png">
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="//gsvnet.nl/images/app-icons/AppIcon57x57.png">
    <link rel="apple-touch-icon" href="//gsvnet.nl/images/app-icons/AppIcon60x60.png">
    <link rel="apple-touch-icon" sizes="120x120" href="//gsvnet.nl/images/app-icons/AppIcon60x60-2x.png">
    <link rel="apple-touch-icon" sizes="76x76" href="//gsvnet.nl/images/app-icons/AppIcon76x76.png">
    <link rel="apple-touch-icon" sizes="152x152" href="//gsvnet.nl/images/app-icons/AppIcon72x72-2x.png">
    <link rel="apple-touch-icon" sizes="29x29" href="//gsvnet.nl/images/app-icons/AppIcon29x29.png">
    <link rel="apple-touch-icon" sizes="58x58" href="//gsvnet.nl/images/app-icons/AppIcon29x29-2x.png">
    <link rel="apple-touch-icon" sizes="40x40" href="//gsvnet.nl/images/app-icons/AppIcon40x40.png">
    <link rel="icon" href="/favicon.png">

    <meta name="theme-color" content="#5b2b92">

    <!--[if lt IE 9]>
        <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=PT+Sans:400,700|PT+Serif:400,700,400italic">
    @section('stylesheets')
        <!-- Stylesheets -->
        <link rel="stylesheet" href="/stylesheets/screen.css?v=1.10.0">
    @show
</head>
<body id="@yield('body-id', 'gsvnet')">
    @section('header')
        <div class="overal-header">
            @include('layouts.header')
            @yield('top-slideshow')
        </div>
    @show

    @yield('content')

    @section('word-lid')
        @if (Auth::guest() || Gate::allows('user.become-member'))
        <div class="hero-unit purple">
            <p class="center"><a href="{{ URL::action('MemberController@becomeMember') }}" class="button">Word lid!</a></p>
        </div>
        @endif
    @show

    @section('footer')
        <footer class="site-footer column-holder">
            <p>Caput sapientiae est reverentia Domini</p>
            <address class="address-info" itemscope itemtype="http://data-vocabulary.org/Organization">
                <p>
                    <span itemprop="name"><a href="//www.gsvnet.nl/" itemprop="url">Gereformeerde Studenten Vereniging</a></span>.
                    <span itemprop="address" itemscope itemtype="http://data-vocabulary.org/Address">
                        <span itemprop="street-address">Hereweg 40</span>,
                        <span itemprop="locality">Groningen</span>.
                        <meta itemprop="region" content="Groningen" />
                        <meta itemprop="country-name" content="Nederland" />
                    </span>
                    <a href="/de-gsv/contact" title="Contact">Contactgegevens.</a>
                </p>
                <meta itemprop="latitude" content="53.2093731" />
                <meta itemprop="longitude" content="6.5723083" />
                <p></p>
            </address>

            <p class="right">
                <i><a href="/privacy-statement" title="Privacyverklaring">Privacyverklaring</a></i>
            </p>
        </footer>
    @show

    @if (Auth::guest())
        @include('login-dialog')
    @endif

    @section('javascripts')
        <script>
            var notificationsUrl = '{{Config::get('gsvnet.notificationsUrl')}}';
        </script>

        @if (Auth::check())
        <script>
            var USER_ID = {{Auth::user()->id}};
        </script>
        @endif

        @include('partials/_proxyredirect')
        
        <script async src="/build-javascripts/app.js?v=1.7.0"></script>

        @if(!Config::get('app.debug'))
            @include('partials/_analytics')
        @endif
    @show
</body>
</html>
