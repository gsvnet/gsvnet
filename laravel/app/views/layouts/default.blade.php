<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{{ $title or 'GSV' }}}</title>

    <meta name="description" content="{{{ $description or 'GSV' }}}" />

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
    </footer>

    @if (Auth::guest())
        @include('login-dialog')
    @endif

    @section('javascripts')
        <script src="/build-javascripts/app.js"></script>
        <script src="/build-javascripts/forum.js"></script>
    @show
</body>
</html>