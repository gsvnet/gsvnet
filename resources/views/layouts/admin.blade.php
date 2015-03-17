<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Admin</title>
        @section('stylesheets')
            <!-- Bootstrap core CSS -->
            <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
            <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
            <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootswatch/3.1.0/yeti/bootstrap.min.css">
            <link rel="stylesheet" href="/stylesheets/admin.css?v=1.3">
        @show

        <link rel="shortcut icon" href="/favicon.png" />
    </head>
    <body>
        <div id="hamburger-icon" class="visible-sm" data-toggle="offcanvas">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="container-fluid">

            @if ($errors->any())
                <ul class='list-unstyled errors'>
                    {!! implode('', $errors->all('<li class="alert alert-danger">:message</li>')) !!}
                </ul>
            @endif

            @if (Session::has('message'))
                <div class="alert alert-success">
                    {!! Session::get('message') !!}
                </div>
            @endif

            <div class="row row-offcanvas row-offcanvas-left">
                <div class="col-lg-2 col-md-3 sidebar-offcanvas">
                    <h3>Administratie</h3>
                    @include('layouts.admin.nav')
                </div>
                <div class="col-lg-10 col-md-9" role="main">
                    @yield('content')
                </div>
            </div>
        </div>

        @section('javascripts')
            <script src="/build-javascripts/admin.js?v=1.3"></script>
        @show
    </body>
</html>