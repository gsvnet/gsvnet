@section('content')
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

@stop