@section('content')
	<div class="column-holder" role="main">
		<h1>Fotogallerij</h1>
		<p class="delta">Voeg een album toe of bewerk oude albums</p>

		<h2>Album toevoegen</h2>
		<div class="create-album">
			Formuliertje
		</div>

		<h2>Albums bewerken</h2>
		<table>
			<thead>
				<tr>
					<th>Naam</th>
					<td>Omschrijving</td>
					<td colspan="3">Aantal foto's</td>
				</tr>
			</thead>
			<tbody>
				@foreach($albums as $album)
				<tr>
					<td><a href="{{ URL::action('Admin\AlbumController@show', $album->id) }}" alt="{{ $album->name }}">
						{{ $album->name }}
					</a></td>
					<td>
						{{$album->description }}
					</td>
					<td>
						1
					</td>
					<td><a href="{{ URL::action('Admin\AlbumController@edit', $album->id) }}" alt="Bewerk {{ $album->name }}">
						Bewerken
					</a></td>
					<td><a href="{{ URL::action('Admin\AlbumController@destroy', $album->id) }}" alt="Verwijder {{ $album->name }}">
						Verwijderen
					</a></td>
				</tr>
				@endforeach
			</tbody>
		</table>

		{{ $albums->links() }}

	</div>
@stop