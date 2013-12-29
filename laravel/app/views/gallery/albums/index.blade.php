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
			<div class="photo-grid-row">
				@include('gallery._album', array('album' => $albums[0], 'first' => 'first', 'wide' => ''))
				@include('gallery._album', array('album' => $albums[1], 'first' => '', 'wide' => ''))
				@include('gallery._album', array('album' => $albums[2], 'first' => '', 'wide' => ''))
			</div>
			<div class="photo-grid-row">
				@include('gallery._album', array('album' => $albums[4], 'first' => 'first', 'wide' => 'wide'))
				@include('gallery._album', array('album' => $albums[5], 'first' => '', 'wide' => ''))
			</div>
			<div class="photo-grid-row">
				@include('gallery._album', array('album' => $albums[5], 'first' => 'first', 'wide' => ''))
				@include('gallery._album', array('album' => $albums[6], 'first' => '', 'wide' => ''))
				@include('gallery._album', array('album' => $albums[7], 'first' => '', 'wide' => ''))
			</div>
			<div class="photo-grid-row">
				@include('gallery._album', array('album' => $albums[8], 'first' => 'first', 'wide' => ''))
				@include('gallery._album', array('album' => $albums[9], 'first' => '', 'wide' => 'wide'))
			</div>
		</div>

		{{ $albums->links() }}

	</div>
@stop