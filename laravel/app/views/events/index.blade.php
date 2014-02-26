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

				@foreach ($events as $event)
					<div class="event-row">
						<div class="event-details">
							<div class="event-image {{{$types[$event->type] or ''}}}"></div>
							<div class="event-date">
								{{{$event->start_date_formatted}}}
							</div>
						</div>
						<div class="event-body">
							<h3>
								<a href="{{ URL::action('EventController@showEvent', $event->id) }}">
									{{{ $event->title}}}
								</a>
							</h3>
							<p>{{ $event->description }}</p>
						</div>
					</div>
				@endforeach
			</div>

			{{ $events->links() }}
		</div>
	</div>
@stop