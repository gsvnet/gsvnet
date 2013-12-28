
<!DOCTYPE html>
<html lang="nl">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
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
            <li class="active"><a href="#">Albums</a></li>
            <li><a href="#about">Gebruikers</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-3">

          <h3>Administratie</h3>
          <div class="list-group list-group-mfc">
            <a href="{{ URL::action('Admin\AlbumController@index') }}" class="list-group-item {{ Request::segment(2) == 'albums' ? 'active' : '' }}">
              <i class='glyphicon glyphicon-calendar'></i> Albums
            </a>

            <a href="{{ URL::route('get-logout') }}" class="list-group-item">
              <i class="glyphicon glyphicon-log-out"></i> Uitloggen
            </a>
          </div>

        </div>
        <div class="col-md-9" role="main">
          @if (Session::has('message'))
              <div class="alert alert-success">
                  {{ Session::get('message') }}
              </div>
          @endif
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
    @show
  </body>
</html>
