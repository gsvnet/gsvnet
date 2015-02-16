<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Admin</title>
        @section('stylesheets')
            <!-- Bootstrap core CSS -->
            <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
            <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
            <link rel="stylesheet" href="/stylesheets/admin.css">

            <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootswatch/3.1.0/yeti/bootstrap.min.css">
        @show

        <link rel="shortcut icon" href="/favicon.png" />
    </head>
    <body>
        <div class="navbar navbar-inverse" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">GSVnet backend</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="/">Front end</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="{{ URL::action('SessionController@getLogout') }}">
                                <i class="glyphicon glyphicon-log-out"></i> Uitloggen
                            </a>
                        </li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
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

            <div class="row">
                <div class="col-lg-2 col-md-3">
                    <h3>Administratie</h3>
                    @include('layouts.admin.nav')
                </div>
                <div class="col-lg-10 col-md-9" role="main">
                    @yield('content')
                </div>
            </div>
        </div>

        @section('javascripts')
            <script src="/build-javascripts/admin.js?v=1.1"></script>
        @show
    </body>
</html>