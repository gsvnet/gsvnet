@section('content')
	<div class="column-holder" role="main">
		<h1>Activiteiten, feesten en borrels</h1>
		<p class="delta">De GSV bruist van leuke activiteiten en clich&eacute;beschrijvingen die niemand leest. Geef je op en kom langs!</p>

		@include('events.sidebar')

		<div class="main-content">
			<div class="event-container">
				@if($searchTimeRange)
				<h2>Activiteiten in {{$month}} {{$year}}</h2>
				@else
				<h2>Komende activiteiten</h2>
				@endif

				@if(count($events) == 0)
					<p>Helaas, geen activiteiten in deze tijd</p>
				@else
					@foreach ($events as $event)
						@include('events._event')
					@endforeach
				@endif
			</div>

			{{ $events->links() }}
		</div>
	</div>
@stop