<div class="list-group">

    <a href="{{ URL::action('Admin\UsersController@index') }}" class="list-group-item {{ Request::segment(2) == 'gebruikers' ? 'active' : '' }}">
        <i class='glyphicon glyphicon-user'></i> Gebruikers
    </a>

     <a href="{{ URL::action('Admin\CommitteeController@index') }}" class="list-group-item {{ Request::segment(2) == 'commissies' ? 'active' : '' }}">
        <i class='glyphicon glyphicon-list-alt'></i> Commissies
    </a>

    <a href="{{ URL::action('Admin\EventController@index') }}" class="list-group-item {{ Request::segment(2) == 'events' ? 'active' : '' }}">
        <i class='glyphicon glyphicon-calendar'></i> Activiteiten
    </a>

    <a href="{{ URL::action('Admin\AlbumController@index') }}" class="list-group-item {{ Request::segment(2) == 'albums' ? 'active' : '' }}">
        <i class='glyphicon glyphicon-picture'></i> Albums
    </a>

    <a href="{{ URL::action('Admin\FilesController@index') }}" class="list-group-item {{ Request::segment(2) == 'files' ? 'active' : '' }}">
        <i class='glyphicon glyphicon-hdd'></i> GSVdocs
    </a>



</div>