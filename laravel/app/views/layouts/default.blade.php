<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Serif:400,700,400italic">
    @section('stylesheets')
        <!-- Stylesheets -->
        <link rel="stylesheet" href="stylesheets/screen.css">
    @show
</head>
<body>
    <div class="overal-header">
        @section('header')
            <header class="top-header">
                <nav class="nav-bar">
                    <div class="nav-bar-extras">
                        <h1 class="logo">
                            <a class="logo-link" href="/public"><span>Gereformeerde Studentenvereniging Groningen</span></a>
                        </h1>
                        <button id="navbar-toggler" class="nav-toggle">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <ul id="main-menu" class="nav-bar-links">
                        <li class="top-level-menuitem"><a class="top-level-link" href="/">Home</a></li>
                        <li class="top-level-menuitem"><a class="top-level-link" href="/de-gsv">De GSV</a></li>
                        <li class="top-level-menuitem"><a class="top-level-link" href="/#">Forum</a></li>
                        <li class="top-level-menuitem"><a class="top-level-link" href="/media">Fotoalbum</a></li>
                        <li class="top-level-menuitem"><a class="top-level-link" href="/activiteiten">Activiteiten</a></li>
                        <li class="top-level-menuitem"><a class="top-level-link" href="/word-lid">Word lid!</a></li>
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

    @yield('content')

    @section('word-lid')
        <div class="hero-unit purple">
            <p class="center"><a href="word-lid" class="button">Word lid!</a></p>
        </div>
    @show

    <footer class="site-footer">
        <p>Caput sapientiae est reverentia domini</p>
    </footer>

    @include('login-dialog')

    @section('javascripts')
        <script src="javascripts/jquery-1.10.1.min.js"></script>
        <script src="javascripts/magnific-popup-0.9.4.js"></script>
        <script src="javascripts/overall.js"></script>
    @show
</body>
</html>