<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test</title>
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
                    <h1 class="logo"><a class="logo-link" href="/public"><span>GSV</span></a></h1>
                    <ul class="nav-bar-links">
                        <li class="top-level-menuitem"><a class="top-level-link" href="/">Home</a></li>
                        <li class="top-level-menuitem"><a class="top-level-link" href="/over">De GSV</a></li>
                        <li class="top-level-menuitem"><a class="top-level-link" href="/#">Forum</a></li>
                        <li class="top-level-menuitem"><a class="top-level-link" href="/foto-albums">Fotoalbum</a></li>
                        <li class="top-level-menuitem"><a class="top-level-link" href="/activiteiten">Activiteiten</a></li>
                        <li class="top-level-menuitem"><a class="top-level-link" href="/word-lid">Word lid!</a></li>
                        <li class="top-level-menuitem"><a class="top-level-link login-link" href="/login" data-mfp-src="#login-dialog">Inloggen</a></li>
                    </ul>
                </nav>
            </header>
        @show
    </div>

    @yield('content')

    @section('word-lid')
        <div class="hero-unit">
            <p class="center"><a href="word-lid.html" class="button">Word lid!</a></p>
        </div>
    @show

    <footer class="site-footer">
        <p>Caput sapientiae est reverentia domini</p>
    </footer>

    <div id="login-dialog" class="zoom-anim-dialog mfp-hide">
        <h2>Login</h2>
        <form class="form-horizontal">
            <div class="control-group">
                <label class="control-label" for="inputEmail">Email</label>
                <div class="controls">
                    <input type="text" id="inputEmail" placeholder="Email">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputPassword">Wachtwoord</label>
                <div class="controls">
                    <input type="password" id="inputPassword" placeholder="Wachtwoord">
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <label class="checkbox">
                        <input type="checkbox"> Onthoud mij
                    </label>
                    <button type="submit" class="btn">Log in</button>
                </div>
            </div>
        </form>
    </div>

    @section('javascripts')
        <script src="javascripts/jquery-1.10.1.min.js"></script>
        <script src="javascripts/magnific-popup-0.9.4.js"></script>
        <script src="javascripts/overall.js"></script>
    @stop
</body>
</html>