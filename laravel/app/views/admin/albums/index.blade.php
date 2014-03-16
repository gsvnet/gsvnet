@section('content')
    <div class="page-header">
    	<h1>Fotoalbums</h1>
    </div>
	<p class="delta">Voeg een album toe of bewerk oude albums</p>


    <section class="spacer row">
		<div class="col-xs-12 col-md-6" id="huidige-albums">
			<h2><i class="fa fa-edit"></i> Albums bewerken</h2>
			<table class='table table-bordered'>
				<thead>
					<tr>
						<th>Naam</th>
						<td>Aantal foto's</td>
		                <td>Laatst bewerkt</td>
					</tr>
				</thead>
				<tbody>
					@foreach($albums as $album)
					<tr>
						<td><a href="{{ URL::action('Admin\AlbumController@show', $album->id) }}" alt="{{ $album->name }}">
							{{{ $album->name }}}
						</a></td>
						<td>
							{{{ $album->photos->count()}}}
						</td>

		                <td>
		                    {{{ $album->updated_at }}}
		                </td>

						<!-- <td>
		                    <a href="{{ URL::action('Admin\AlbumController@edit', $album->id) }}" alt="Bewerk {{{ $album->name }}}" class='btn btn-default'>
		                        <i class="fa fa-pencil"></i> Album informatie bewerken
		                    </a>
		                </td> -->

					</tr>
					@endforeach
				</tbody>
			</table>

			{{ $albums->links() }}
        </div>
        <div class="col-xs-12 col-md-6" id="album-toevoegen">
			@include('admin.albums.create')
        </div>
    </section>

@stop