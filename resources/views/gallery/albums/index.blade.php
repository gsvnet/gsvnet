@extends('layouts.default')

@section('title', 'Fotoalbum')
@section('description', 'Bekijk hier foto\'s van soosavonden, sing-ins, kampen, weekenden, wedstrijden, lezingen en al wat de GSV nog meer te bieden heeft.')

<?php
	// Dit moet even mooier gedaan worden hoor
    $repeatsAfter = 10;
?>

@section('content')
	<div class="column-holder" role="main">
		<h1>Fotogallerij</h1>
		<p class="delta">Krijg een impressie van de leukste studentenvereniging van Groningen</p>

		<div class="gallery">
			@for($i=0; $i<count($albums); $i++)
				@include('gallery._album', array('album' => $albums[$i], 'description' => $albums[$i]->name, 'wide' => $i % $repeatsAfter == 4 || $i % $repeatsAfter == 8, 'class' => 'tile-number-' . ($i % $repeatsAfter)))

			@endfor
		</div>

		{!! $albums->render() !!}
	</div>
@stop