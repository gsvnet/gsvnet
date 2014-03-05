@section('content')
<div class="panel panel-default">
  <div class="panel-heading">
    <ul class="nav nav-tabs">
        <li class="{{ Request::segment(3) == '' ? 'active' : '' }}">
            <a href="{{ URL::action('Admin\UsersController@index') }}">
                <i class='glyphicon glyphicon-user'></i> Alle
            </a>
        </li>

        <li class="{{ Request::segment(3) == 'gasten' ? 'active' : '' }}">
            <a href="{{ URL::action('Admin\UsersController@showGuests') }}">
                <i class='glyphicon glyphicon-user'></i> Gasten
            </a>
        </li>

        <li class="{{ Request::segment(3) == 'potentiaal' ? 'active' : '' }}">
            <a href="{{ URL::action('Admin\UsersController@showPotentials') }}">
                <i class='glyphicon glyphicon-user'></i> Potentiaalen
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
    </ul>
</div>
  <div class="panel-body">

    <div class="page-header">
    	<h1>Gebruikers</h1>
    </div>
	<p class="delta">Voeg een gebruiker toe of bewerk oude gebruikers</p>

    <a href="{{{ URL::action('Admin\UsersController@create') }}}" class='btn btn-success'>
        <span class="glyphicon glyphicon-plus"></span>
        Gebruiker toevoegen
    </a>

	<h2>Gebruikers bewerken</h2>
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>Naam</th>
                <td>Email</td>
                <td>User type</td>
                <td>Laatst bewerkt</td>
			</tr>
		</thead>
		<tbody>
			@foreach($users as $user)
			<tr>
				<td>
                <a href="{{ URL::action('Admin\UsersController@show', $user->id) }}" alt="{{ $user->full_name }}">
					{{{ $user->full_name }}}
				</a>
                </td>

                <td>
                    {{{ $user->email }}}
                </td>

                <td>
                    {{{ $user->type }}}
                </td>

                <td>
                    {{{ $user->updated_at }}}
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

  </div>
</div>

@stop