<?php
	// Dit moet even mooier gedaan worden hoor
	$classes = ['', 'last-2', 'last-3', 'last-2', 'wide last-2 last-3', '', 'last-2', 'last-3', 'wide last-2', 'last-2 last-3'];
	$number = count($classes);
?>

@section('content')
	<div class="column-holder" role="main">
		<h1>Fotogallerij</h1>
		<p class="delta">Krijg een impressie van de leukste studentenvereniging van Groningen</p>

		<div class="gallery">
			@for($i=0; $i<count($albums); $i++)
				@include('gallery._album', array('album' => $albums[$i], 'wide' => ($i==4 || $i==8), 'class' => $classes[$i % $number]))
			@endfor
		</div>

		{{ $albums->links() }}
	</div>
@stop