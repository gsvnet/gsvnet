@section('content')
    <ul class="nav nav-tabs">
        <li class="{{ Request::segment(3) == '' ? 'active' : '' }}">
            <a href="{{ URL::action('Admin\UsersController@index') }}">
                <i class='glyphicon glyphicon-user'></i> Alle
            </a>
        </li>

        <li class="{{ Request::segment(3) == 'leden' ? 'active' : '' }}">
            <a href="{{ URL::action('Admin\UsersController@showMembers') }}">
                <i class='glyphicon glyphicon-user'></i> Leden
            </a>
        </li>

        <li class="{{ Request::segment(3) == 'oud-leden' ? 'active' : '' }}">
            <a href="{{ URL::action('Admin\UsersController@showFormerMembers') }}">
                <i class='glyphicon glyphicon-user'></i> Oud leden
            </a>
        </li>

        <li class="{{ Request::segment(3) == 'novieten' ? 'active' : '' }}">
            <a href="{{ URL::action('Admin\UsersController@showPotentials') }}">
                <i class='glyphicon glyphicon-user'></i> Novieten
            </a>
        </li>

        <li class="{{ Request::segment(3) == 'gasten' ? 'active' : '' }}">
            <a href="{{ URL::action('Admin\UsersController@showGuests') }}">
                <i class='glyphicon glyphicon-user'></i> Gasten
            </a>
        </li>
    </ul>

	<h2>Lijst met mensen</h2>
    <!-- Hier nog zoiets doen: select count(*), type from users group by type -->
    <!-- Hier nog zoiets doen: select count(*), type from users where approved = 0   group by type -->
	<table class='table table-striped table-hover sort-table' style="width:auto;">
		<thead>
			<tr>
                <th>Gebruikersnaam</th>
				<th>Voornaam</th>
                <th>tussenvoegsel</th>
                <th>Achternaam</th>
                <th>Email</th>
                <th>Soort</th>
                <th>Superkrachten</th>
			</tr>
		</thead>
		<tbody>
			@foreach($users as $user)
			<tr>
                <td>
                <a href="{{ URL::action('Admin\UsersController@show', $user->id) }}" alt="{{ $user->present()->fullName }}">
                    {{{ $user->username }}}
                </a>
                </td>

                <td>{{{ $user->firstname }}}</td>
                <td>{{{ $user->middlename }}}</td>
                <td>{{{ $user->lastname }}}</td>
                <td>{{{ $user->email }}}</td>
                <td>{{{ $user->present()->membershipType }}}</td>

                <td>

                    @if (! $user->approved)
                    {{
                        Former::inline_open()
                          ->action(action('Admin\UsersController@activate', $user->id))
                    }}
                        <button type='submit' class='btn btn-success btn-xs'>
                            <i class="glyphicon glyphicon-ok"></i> Registratie goedkeuren
                        </button>
                    {{
                        Former::close();
                    }}
                    @endif

                    @if ($user->type == 'potential')
                    {{
                        Former::inline_open()
                          ->action(action('Admin\UsersController@accept', $user->id))
                          ->style('float: left; margin-right: 1em;')
                    }}
                    {{-- Die styling is wel heel erg lelijk, maar is nu eerst even puur om het te testen --}}
                        <button type='submit' class='btn btn-warning btn-xs'>
                            <i class="glyphicon glyphicon-ok"></i> Lid installeren
                        </button>
                    {{
                        Former::close();
                    }}
                    @endif
                </td>

				<!-- <td>
                    <a href="{{ URL::action('Admin\UsersController@edit', $user->id) }}" alt="Bewerk {{{ $user->name }}}" class='btn btn-default'>
                        <i class="fa fa-pencil"></i> Album informatie bewerken
                    </a>
                </td> -->

			</tr>
			@endforeach
		</tbody>
	</table>

	{{ $users->links() }}

    <div class="page-header">
        <h1>Gebruikers</h1>
    </div>
    <p class="delta">Voeg een gebruiker toe of bewerk oude gebruikers</p>

    <a href="{{{ URL::action('Admin\UsersController@create') }}}" class='btn btn-success'>
        <span class="glyphicon glyphicon-plus"></span>
        Gebruiker toevoegen
    </a>

@stop