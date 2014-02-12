
<!DOCTYPE html>
<html lang="nl">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin</title>
    @section('stylesheets')
      <!-- Bootstrap core CSS -->
      <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.10/css/bootstrap.min.css">
      <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">

      <style type="text/css">
        .add-form {
          /*display: none;*/
        }
      </style>

      <!-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootswatch/3.1.0/journal/bootstrap.min.css"> -->
      <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootswatch/3.1.0/yeti/bootstrap.min.css">
      <!-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootswatch/3.1.0/lumen/bootstrap.min.css"> -->

      <style>
      body {
        font-size: 150%;
      }
      </style>

    @show
  </head>


  <body>

    <div class="navbar navbar-inverse" role="navigation">
      <div class="container">
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
            <li><a href="{{ URL::action('SessionController@getLogout') }}"><i class="glyphicon glyphicon-log-out"></i> Uitloggen</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">
        @if ($errors->any())
              <ul class='list-unstyled errors'>
                  {{ implode('', $errors->all('<li class="alert alert-danger">:message</li>')) }}
              </ul>
          @endif

          @if (Session::has('message'))
              <div class="alert alert-success">
                  {{ Session::get('message') }}
              </div>
          @endif
      @show
      <div class="row">
        <div class="col-md-3">

          <h3>Administratie</h3>
          <div class="list-group list-group-mfc">
            <a href="{{ URL::action('Admin\EventController@index') }}" class="list-group-item {{ Request::segment(2) == 'events' ? 'active' : '' }}">
              <i class='glyphicon glyphicon-calendar'></i> Activiteiten
            </a>
            <a href="{{ URL::action('Admin\AlbumController@index') }}" class="list-group-item {{ Request::segment(2) == 'albums' ? 'active' : '' }}">
              <i class='glyphicon glyphicon-picture'></i> Albums
            </a>

            <a href="{{ URL::action('Admin\FilesController@index') }}" class="list-group-item {{ Request::segment(2) == 'files' ? 'active' : '' }}">
              <i class='glyphicon glyphicon-hdd'></i> GSVdocs
            </a>

            <a href="{{ URL::action('Admin\CommitteeController@index') }}" class="list-group-item {{ Request::segment(2) == 'commissies' ? 'active' : '' }}">
              <i class='glyphicon glyphicon-list-alt'></i> Commissies
            </a>
          </div>

        </div>
        <div class="col-md-9" role="main">
          @yield('content')
        </div>
      </div>

    </div>


    @section('javascripts')
      <!-- Bootstrap core JavaScript
      ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
      <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
      <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>

      <script>
        $(document).ready(function() {
            $('.add-item').on('click', function () {
                $('.add-form').toggle('fast');
            });
            // Hide success message after 2.5 seconds
            $('.alert.alert-success').delay(2500).slideUp(500);
        });
    </script>
    @show
  </body>
</html>
