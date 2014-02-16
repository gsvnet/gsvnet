@section('content')
	<div class="column-holder" role="main">
		<h1>Activiteiten, feesten en borrels</h1>
		<p class="delta">De GSV bruist van leuke activiteiten en clich&eacute;beschrijvingen die niemand leest. Geef je op en kom langs!</p>

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
							<div class="event-date">22 jan{{--{$event->start_date}--}}</div>
						</div>
						<div class="event-body">
							<h3><a href="{{ URL::action('EventController@showEvent', $event->id) }}">{{{ $event->title}}}</a></h3>
							<p>{{ $event->description }}</p>
						</div>
					</div>
				@endforeach

			</div>

			{{ $events->links() }}
		</div>
		<div class="secondary-column">
			<h2>
			@if($showPrevYear)
				{{link_to_action('EventController@showMonth', $year - 1, $year - 1)}} |
			@endif
			{{link_to_action('EventController@showMonth', $year, $year)}}
			@if($showNextYear)
				| {{link_to_action('EventController@showMonth', $year + 1, $year + 1)}}
			@endif
			</h2>
			<ul class="list secondary-menu">
				<?php
					$months = array('januari', 'februari', 'maart', 'april', 'mei', 'juni', 'juli', 'augustus', 'september', 'oktober', 'november', 'december');
				?>
				@foreach ($months as $month)
					<li>{{link_to_action('EventController@showMonth', $month, array($year, $month))}}</li>
				@endforeach
			</ul>
		</div>
	</div>
@stop