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
						<h3><a href="{{ route('show_event', $event->id) }}">{{ $event->title}}</a></h3>
						<p>{{ $event->description }}</p>
						<small>{{{ $event->hoi() }}}</small>
					</div>
				@endforeach

			</div>

			{{ $events->links() }}
		</div>
		<div class="secondary-column">
			<h2>{{link_to_action('EventController@showMonth', $year - 1, $year - 1)}} | {{link_to_action('EventController@showMonth', $year, $year)}} | {{link_to_action('EventController@showMonth', $year + 1, $year + 1)}}</h2>
			<ul class="list secondary-menu">
				<?php
					$months = array('januari', 'februari', 'maart', 'april', 'mei', 'juni', 'juli', 'augustus', 'september', 'oktober', 'november', 'december');
				?>
				@foreach ($months as $month)
					<li>{{link_to_action('EventController@showMonth', $month, array(2013, $month))}}</li>
				@endforeach
			</ul>
		</div>
	</div>
@stop