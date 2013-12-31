<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>

    <meta name="description" content="{{{ $description }}}" />
    <meta name="keywords" content="{{{ $keywords }}}" />

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Serif:400,700,400italic">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">

    @section('stylesheets')
        <!-- Stylesheets -->
        <link rel="stylesheet" href="/stylesheets/screen.css">
    @show
</head>
<body>
    <div class="overal-header">

        @yield('top-slideshow')
        @include('layouts.header')
    </div>

    @yield('content')

    @section('word-lid')
        @if (Auth::guest() || !Auth::user()->isMember())
        <div class="hero-unit purple">
            <p class="center"><a href="{{ URL::action('HomeController@wordLid') }}" class="button">Word lid!</a></p>
        </div>
        @endif
    @show

    <footer class="site-footer">
        <p>Caput sapientiae est reverentia domini</p>
    </footer>

    @if (Auth::guest())
        @include('login-dialog')
    @endif

    @section('javascripts')
        <script src="/javascripts/jquery-1.10.1.min.js"></script>
        <script src="/javascripts/magnific-popup-0.9.9.js"></script>
        <script src="/javascripts/overall.js"></script>
    @show
</body>
</html>