<div class="list-group">
    <a href="/admin" class="list-group-item {{ Request::segment(2) == '' ? 'active' : '' }}">
        <i class='glyphicon glyphicon-home'></i> Dashboard
    </a>
</div>

<h4>Ledenadministratie</h4>
<div class="list-group">
    @if (Permission::has('users.show'))
        <a href="{{ URL::action('Admin\UsersController@showMembers') }}" class="list-group-item {{ Request::segment(2) == 'gebruikers' && Request::segment(3) == 'leden' ? 'active' : '' }}">
            <i class='glyphicon glyphicon-user'></i> Leden
        </a>

        <a href="{{ URL::action('Admin\UsersController@showFormerMembers') }}" class="list-group-item {{ Request::segment(2) == 'gebruikers' && Request::segment(3) == 'oud-leden' ? 'active' : '' }}">
            <i class='glyphicon glyphicon-user'></i> Oud-leden
        </a>

        <a href="{{ URL::action('Admin\UsersController@showPotentials') }}" class="list-group-item {{ Request::segment(2) == 'gebruikers' && Request::segment(3) == 'novieten' ? 'active' : '' }}">
            <i class='glyphicon glyphicon-user'></i> Novieten
        </a>

        <a href="{{ URL::action('Admin\UsersController@create') }}" class="list-group-item {{ Request::segment(2) == 'gebruikers' && Request::segment(3) == 'create' ? 'active' : '' }}">
            <i class="fa fa-plus"></i> Gebruikers &amp; leden registreren
        </a>
    @endif
</div>

<h4>Forum</h4>
<div class="list-group">

    @if (Permission::has('users.show'))
    <a href="{{ URL::action('Admin\UsersController@showGuests') }}" class="list-group-item {{ Request::segment(3) == 'gasten' ? 'active' : '' }}">
        <i class='glyphicon glyphicon-user'></i> Forum-gebruikers
    </a>
    @endif
</div>

<h4>Activiteiten</h4>
<div class="list-group">
    @if (Permission::has('events.manage'))
        <a href="{{ URL::action('Admin\EventController@index') }}" class="list-group-item {{ Request::segment(2) == 'events' && Request::segment(3) != 'create' ? 'active' : '' }}">
            <i class='glyphicon glyphicon-calendar'></i> Activiteiten
        </a>

        <a href="{{ URL::action('Admin\EventController@create') }}" class="list-group-item {{ Request::segment(2) == 'events' && Request::segment(3) == 'create' ? 'active' : '' }}">
            <i class='fa fa-plus'></i> Toevoegen
        </a>
    @endif
</div>


<h4>Overig</h4>
<div class="list-group">

    @if (Permission::has('photos.manage'))
        <a href="{{ URL::action('Admin\AlbumController@index') }}" class="list-group-item {{ Request::segment(2) == 'albums' ? 'active' : '' }}">
            <i class='glyphicon glyphicon-picture'></i> Albums
        </a>
    @endif

    @if (Permission::has('committees.manage'))
    <a href="{{ URL::action('Admin\CommitteeController@index') }}" class="list-group-item {{ Request::segment(2) == 'commissies' ? 'active' : '' }}">
        <i class='glyphicon glyphicon-list-alt'></i> Commissies
    </a>
    @endif

    @if (Permission::has('docs.manage'))
    <a href="{{ URL::action('Admin\FilesController@index') }}" class="list-group-item {{ Request::segment(2) == 'files' ? 'active' : '' }}">
        <i class='glyphicon glyphicon-hdd'></i> GSVdocs
    </a>
    @endif

    @if (Permission::has('senates.manage'))
    <a href="{{ URL::action('Admin\SenateController@index') }}" class="list-group-item {{ Request::segment(2) == 'senaten' ? 'active' : '' }}">
        <i class='glyphicon glyphicon-tower'></i> Senaten
    </a>
    @endif

</div>