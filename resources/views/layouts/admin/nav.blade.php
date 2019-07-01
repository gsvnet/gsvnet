<div class="list-group">
    <a href="/admin" class="list-group-item {{ Request::segment(2) == '' ? 'active' : '' }}">
        <i class='glyphicon glyphicon-home'></i> Dashboard
    </a>
    @can('users.show')
        <a href="{{ action('Admin\UsersController@show', [Auth::user()->id]) }}" class="list-group-item">
            <i class='glyphicon glyphicon-user'></i> Uw profiel
        </a>
    @endcan
</div>

<h4>Ledenadministratie</h4>
<div class="list-group">
    @can('users.show')
        <a href="{{ action('Admin\MemberController@latestUpdates') }}" class="list-group-item {{ Request::segment(2) == 'leden' && Request::segment(3) == 'updates' ? 'active' : '' }}">
            <i class="fa fa-rss"></i> Laatste updates
        </a>
        <a href="{{ action('Admin\UsersController@showMembers') }}" class="list-group-item {{ Request::segment(2) == 'gebruikers' && Request::segment(3) == 'leden' ? 'active' : '' }}">
            <i class='glyphicon glyphicon-user'></i> Leden
        </a>

        <a href="{{ action('Admin\UsersController@showFormerMembers') }}" class="list-group-item {{ Request::segment(2) == 'gebruikers' && Request::segment(3) == 'oud-leden' ? 'active' : '' }}">
            <i class='glyphicon glyphicon-user'></i> Oud-leden
        </a>

        <a href="{{ action('Admin\UsersController@showPotentials') }}" class="list-group-item {{ Request::segment(2) == 'gebruikers' && Request::segment(3) == 'novieten' ? 'active' : '' }}">
            <i class='glyphicon glyphicon-user'></i> Novieten
        </a>
    @endcan

    @can('users.manage')
        <a href="{{ action('Admin\UsersController@create') }}" class="list-group-item {{ Request::segment(2) == 'gebruikers' && Request::segment(3) == 'create' ? 'active' : '' }}">
            <i class="fa fa-plus"></i> Gebruikers &amp; leden registreren
        </a>
    @endcan
</div>

<h4>Forum</h4>
<div class="list-group">

    @can('users.show')
    <a href="{{ action('Admin\UsersController@showGuests') }}" class="list-group-item {{ Request::segment(3) == 'gasten' ? 'active' : '' }}">
        <i class='glyphicon glyphicon-user'></i> Forum-gebruikers
    </a>
    @endcan
</div>

<h4>Activiteiten</h4>
<div class="list-group">
    @can('events.manage')
        <a href="{{ action('Admin\EventController@index') }}" class="list-group-item {{ Request::segment(2) == 'events' && Request::segment(3) != 'create' ? 'active' : '' }}">
            <i class='glyphicon glyphicon-calendar'></i> Activiteiten
        </a>

        <a href="{{ action('Admin\EventController@create') }}" class="list-group-item {{ Request::segment(2) == 'events' && Request::segment(3) == 'create' ? 'active' : '' }}">
            <i class='fa fa-plus'></i> Toevoegen
        </a>
    @endcan
</div>


<h4>Overig</h4>
<div class="list-group">

    @can('photos.manage')
        <a href="{{ action('Admin\AlbumController@index') }}" class="list-group-item {{ Request::segment(2) == 'albums' ? 'active' : '' }}">
            <i class='glyphicon glyphicon-picture'></i> Albums
        </a>
    @endcan

    @can('committees.manage')
    <a href="{{ action('Admin\CommitteeController@index') }}" class="list-group-item {{ Request::segment(2) == 'commissies' ? 'active' : '' }}">
        <i class='glyphicon glyphicon-list-alt'></i> Commissies
    </a>
    @endcan

    @can('docs.manage')
    <a href="{{ action('Admin\FilesController@index') }}" class="list-group-item {{ Request::segment(2) == 'files' ? 'active' : '' }}">
        <i class='glyphicon glyphicon-hdd'></i> GSVdocs
    </a>
    @endcan

    @can('senates.manage')
    <a href="{{ action('Admin\SenateController@index') }}" class="list-group-item {{ Request::segment(2) == 'senaten' ? 'active' : '' }}">
        <i class='glyphicon glyphicon-tower'></i> Senaten
    </a>
    @endcan

    @can('extension.manage')
    <a href="{{ action('Admin\ExtensionController@index') }}" class="list-group-item {{ Request::segment(2) == 'extension' ? 'active' : '' }}">
        <i class='glyphicon glyphicon-plus'></i> Extensie
    </a>
    @endcan
</div>