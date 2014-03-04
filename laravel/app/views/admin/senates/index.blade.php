@section('content')
    <div class="page-header">
    	<h1>Senaten</h1>
    </div>
	<p class="delta">Voeg een senaat toe of bewerk er een</p>

	@include('admin.senates.create')

	<h2>Senaten bewerken</h2>
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>Naam</th>
				<td>Leden</td>
                <td>Laatst bewerkt</td>
			</tr>
		</thead>
		<tbody>
			@foreach($senates as $senate)
			<tr>
				<td><a href="{{ URL::action('Admin\SenateController@show', $senate->id) }}" alt="{{ $senate->name }}">
					{{{ $senate->name }}}
				</a></td>
				<td>
					<ul>
						@foreach($senate->members as $member)
							<li>{{{ $member->full_name }}}</li>
						@endforeach
					</ul>
				</td>

                <td>
                    {{{ $senate->updated_at }}}
                </td>

			</tr>
			@endforeach
		</tbody>
	</table>

	{{ $senates->links() }}

@stop