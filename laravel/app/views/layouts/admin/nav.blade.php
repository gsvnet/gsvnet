<div class="list-group">
    @if (Permission::has('admin'))
    <div></div>
    <a href="{{ URL::action('Admin\UsersController@index') }}" class="list-group-item {{ Request::segment(2) == 'gebruikers' ? 'active' : '' }}">
        <i class='glyphicon glyphicon-user'></i> Gebruikers
    </a>

    <a href="{{ URL::action('Admin\CommitteeController@index') }}" class="list-group-item {{ Request::segment(2) == 'commissies' ? 'active' : '' }}">
        <i class='glyphicon glyphicon-list-alt'></i> Commissies
    </a>
    @endif

    @if (Permission::has('events.manage'))
    <a href="{{ URL::action('Admin\EventController@index') }}" class="list-group-item {{ Request::segment(2) == 'events' ? 'active' : '' }}">
        <i class='glyphicon glyphicon-calendar'></i> Activiteiten
    </a>
    @endif

    @if (Permission::has('photos.manage'))
    <a href="{{ URL::action('Admin\AlbumController@index') }}" class="list-group-item {{ Request::segment(2) == 'albums' ? 'active' : '' }}">
        <i class='glyphicon glyphicon-picture'></i> Albums
    </a>
    @endif

    @if (Permission::has('docs.manage'))
    <a href="{{ URL::action('Admin\FilesController@index') }}" class="list-group-item {{ Request::segment(2) == 'files' ? 'active' : '' }}">
        <i class='glyphicon glyphicon-hdd'></i> GSVdocs
    </a>
    @endif

</div>