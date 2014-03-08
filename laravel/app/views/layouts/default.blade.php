<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{{ $title }}}</title>

    <meta name="description" content="{{{ $description }}}" />
    <meta name="keywords" content="{{{ $keywords }}}" />

    <link rel="shortcut icon" href="/favicon.png" />
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans:400,700|PT+Serif:400,700,400italic">

    @section('stylesheets')
        <!-- Stylesheets -->
        <link rel="stylesheet" href="/stylesheets/screen.css">
    @show
</head>
<body id="{{{ $bodyID or '' }}}" class="svg">
    <div class="overal-header">

        @include('layouts.header')
        @yield('top-slideshow')
    </div>

    @yield('content')

    @section('word-lid')
        @if (Auth::guest() || !Auth::user()->wasOrIsMember())
        <div class="hero-unit purple">
            <p class="center"><a href="{{ URL::action('MemberController@index') }}" class="button">Word lid!</a></p>
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
    @show
</body>
</html>