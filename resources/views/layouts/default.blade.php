<!doctype html>
<html lang="nl" prefix="og: http://ogp.me/ns#">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <meta name="description" content="@yield('description')" >
    <meta property="og:site_name" content="Gereformeerde Studenten Vereniging Groningen">
    <meta property="og:title" content="{{{ $title or 'GSV' }}}">
    <meta property="og:description" content="{{{ !empty($description) ? $description : 'Gereformeerde Studenten Vereniging Groningen' }}}">
    <meta property="og:url" content="{{{Request::url()}}}">
    <meta property="og:type" content="{{ Request::is('/') ? 'website' : 'article' }}">
    <meta property="og:image" content="http://gsvnet.nl/images/facebook.jpg">
    <meta property="og:image:type" content="image/jpg">
    <meta property="og:image:width" content="600">
    <meta property="og:image:height" content="400">

    <link rel="shortcut icon" sizes="57x57" href="http://gsvnet.nl/images/app-icons/AppIcon57x57.png">
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="http://gsvnet.nl/images/app-icons/AppIcon57x57.png">
    <link rel="apple-touch-icon" href="http://gsvnet.nl/images/app-icons/AppIcon60x60.png">
    <link rel="apple-touch-icon" sizes="120x120" href="http://gsvnet.nl/images/app-icons/AppIcon60x60-2x.png">
    <link rel="apple-touch-icon" sizes="76x76" href="http://gsvnet.nl/images/app-icons/AppIcon76x76.png">
    <link rel="apple-touch-icon" sizes="152x152" href="http://gsvnet.nl/images/app-icons/AppIcon72x72-2x.png">
    <link rel="apple-touch-icon" sizes="29x29" href="http://gsvnet.nl/images/app-icons/AppIcon29x29.png">
    <link rel="apple-touch-icon" sizes="58x58" href="http://gsvnet.nl/images/app-icons/AppIcon29x29-2x.png">
    <link rel="apple-touch-icon" sizes="40x40" href="http://gsvnet.nl/images/app-icons/AppIcon40x40.png">
    <link rel="icon" href="/favicon.png">

    <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    @section('stylesheets')
        <!-- Stylesheets -->
        <link rel="stylesheet" href="/stylesheets/screen.css?v=1.5.2">
    @show
</head>
<body id="@yield('body-id', 'gsvnet')">
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
        <script async src="/build-javascripts/app.js?v=1.3.2"></script>
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-48797155-1', 'gsvnet.nl');
          ga('send', 'pageview');
        </script>
    @show
</body>
</html>

<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans:400,700|PT+Serif:400,700,400italic">
