<?php
	// Dit moet even mooier gedaan worden hoor
	$classes = ['', 'last-2', 'last-3', 'last-2', 'wide last-2 last-3', '', 'last-2', 'last-3', 'last-2', 'wide last-2 last-3'];
?>

@section('content')
	<div class="column-holder" role="main">
		<h1>Fotogallerij</h1>
		<p class="delta">Krijg een impressie van de meest geweldige studentenvereniging zus en zo en bla die bla. En zus en zo!</p>

		<!-- <div class="albums">
			@foreach(array_chunk($albums->getCollection()->all(), 3) as $row)
	            <div class="photo-grid-row">
	                @foreach($row as $photo)
	                    @include('gallery._album', array('album' => $photo, 'first' => 'first', 'wide' => ''))
	                @endforeach
	            </div>
	        @endforeach
		</div> -->

		<div class="albums">
			@for($i=0; $i<count($albums); $i++)
				@include('gallery._album', array('album' => $albums[$i], 'wide' => ($i+1)%5==0, 'class' => $classes[$i]))
			@endfor
		</div>

		{{ $albums->links() }}
	</div>
@stop