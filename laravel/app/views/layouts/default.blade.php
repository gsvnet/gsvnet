<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>

    <meta name="description" content="{{ $description }}" />
    <meta name="keywords" content="{{ $keywords }}" />

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Serif:400,700,400italic">
    @section('stylesheets')
        <!-- Stylesheets -->
        <link rel="stylesheet" href="/stylesheets/screen.css">
    @show
</head>
<body>
    <div class="overal-header">
        @section('header')
            <header class="top-header">
                <nav class="nav-bar">
<!--                     <div class="nav-bar-extras">
                        <button id="navbar-toggler" class="nav-toggle">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div> -->

                    <h1 class="logo">
                        <a class="logo-link" href="/"><span>Gereformeerde Studentenvereniging Groningen</span></a>
                    </h1>
                    <ul id="main-menu" class="nav-bar-links">
                        <li class="top-level-menuitem">
                            <a class="top-level-link {{ Request::is('de-gsv*') ? 'active-menu' : '' }}" href="/de-gsv">De GSV</a>
                        </li>
                        <li class="top-level-menuitem">
                            <a class="top-level-link {{ Request::is('forum*') ? 'active-menu' : '' }}" href="/#">Forum</a>
                        </li>
                        <li class="top-level-menuitem">
                            <a class="top-level-link {{ Request::is('albums*') ? 'active-menu' : '' }}" href="/albums">Fotoalbum</a>
                        </li>
                        <li class="top-level-menuitem">
                            <a class="top-level-link {{ Request::is('activiteiten*') ? 'active-menu' : '' }}" href="/activiteiten">Activiteiten</a>
                        </li>

                        @if(Auth::guest() || !Auth::user()->isMember())
                        <li class="top-level-menuitem">
                            <a class="top-level-link {{ Request::is('word-lid*') ? 'active-menu' : '' }}" href="/word-lid">Lid worden?</a>
                        </li>
                        @endif

                        @if(Auth::check() && Auth::user()->can('viewMemberlist'))
                            <li class="top-level-menuitem {{ Request::is('jaarbundel*') ? 'active-menu' : '' }}"><a href="/jaarbundel" class="top-level-link">Jaarbundel</a></li>
                        @endif

                        @if (Auth::check())
                            <li class="top-level-menuitem"><a class="top-level-link" href="/logout">Uitloggen</a></li>
                        @else
                            <li class="top-level-menuitem"><a class="top-level-link login-link" href="/login" data-mfp-src="#login-dialog">Inloggen</a></li>
                        @endif
                    </ul>
                </nav>
            </header>
        @show
    </div>

    @yield('breadcrumb')



    @yield('content')

    @section('word-lid')
        @if(Auth::guest() || !Auth::user()->isMember())
        <div class="hero-unit purple">
            <p class="center"><a href="word-lid" class="button">Word lid!</a></p>
        </div>
        @endif
    @show

    <footer class="site-footer">
        <p>Caput sapientiae est reverentia domini</p>
    </footer>

    @include('login-dialog')

    @section('javascripts')
        <script src="/javascripts/jquery-1.10.1.min.js"></script>
        <script src="/javascripts/magnific-popup-0.9.4.js"></script>
        <script src="/javascripts/overall.js"></script>
    @show
</body>
</html>