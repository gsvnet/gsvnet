@section('content')
    <div class="page-header">
    	<h1>Commissies</h1>
    </div>
	<p class="delta">Voeg een commissie toe of bewerk oude commissies</p>

	@include('admin.committees.create')

	<h2>Commissies bewerken</h2>
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>Naam</th>
				<td>Aantal leden's</td>
                <td>Laatst bewerkt</td>
			</tr>
		</thead>
		<tbody>
			@foreach($committees as $committee)
			<tr>
				<td><a href="{{ URL::action('Admin\CommitteeController@show', $committee->id) }}" alt="{{ $committee->name }}">
					{{{ $committee->name }}}
				</a></td>
				<td>
					{{{ $committee->users->count() }}}
				</td>

                <td>
                    {{{ $committee->updated_at }}}
                </td>

				<!-- <td>
                    <a href="{{ URL::action('Admin\CommitteeController@edit', $committee->id) }}" alt="Bewerk {{{ $committee->name }}}" class='btn btn-default'>
                        <i class="fa fa-pencil"></i> Album informatie bewerken
                    </a>
                </td> -->

			</tr>
			@endforeach
		</tbody>
	</table>

	{{ $committees->links() }}

@stop