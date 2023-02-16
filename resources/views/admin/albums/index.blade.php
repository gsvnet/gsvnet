@extends('layouts.admin')

@section('content')
    <div class="page-header">
    	<h1>Fotoalbums</h1>
    </div>

	<p class="delta">Voeg een album toe of bewerk oude albums</p>

    <section class="spacer row">
		<div class="col-xs-12 col-md-6" id="huidige-albums">
			<h2><i class="fa fa-edit"></i> Albums bewerken</h2>
			<table class='table table-striped table-hover sort-table'>
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
						<td><a href="{{ URL::action([\App\Http\Controllers\Admin\AlbumController::class, 'show'], $album->id) }}" alt="{{ $album->name }}">
							{{ $album->name }}
						</a></td>
						<td>{{ $album->photos->count()}}</td>
		                <td>{{ $album->updated_at }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>

			{!! $albums->render() !!}
        </div>
        <div class="col-xs-12 col-md-6" id="album-toevoegen">
			@include('admin.albums.create')
        </div>
    </section>

@stop