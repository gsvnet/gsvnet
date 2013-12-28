@section('content')
	<div class="column-holder" role="main">
		<h1>Fotogallerij</h1>
		<p class="delta">Voeg een album toe of bewerk oude albums</p>

		<h2>Album toevoegen</h2>

		<section class='create-album panel panel-default panel-info'>
		    <div class="panel-heading add-item">
		        <h4 class="panel-title">Album toevoegen <span class="caret"></span></h4>
		    </div>

		    {{
		        Former::vertical_open()
		            ->action(action('Admin\AlbumController@store'))
		            ->method('POST')
		            ->class('panel-body add-form')
		    }}

		        @include('admin.albums._form')

		        <button type='submit' class='btn btn-success'>
		            <i class="glyphicon glyphicon-ok"></i> Toevoegen
		        </button>

		    {{
		        Former::close()
		    }}

		</section>


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
					<td><a href="{{ URL::action('Admin\AlbumController@show', $album->slug) }}" alt="{{ $album->name }}">
						{{ $album->name }}
					</a></td>
					<td>
						{{$album->description }}
					</td>
					<td>
						1
					</td>
					<td><a href="{{ URL::action('Admin\AlbumController@edit', $album->slug) }}" alt="Bewerk {{ $album->name }}">
						Bewerken
					</a></td>
					<td><a href="{{ URL::action('Admin\AlbumController@destroy', $album->slug) }}" alt="Verwijder {{ $album->name }}">
						Verwijderen
					</a></td>
				</tr>
				@endforeach
			</tbody>
		</table>

		{{ $albums->links() }}

	</div>
@stop