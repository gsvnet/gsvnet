@section('content')
	<div class="column-holder" role="main">
		<h1>Activiteiten, feesten en borrels</h1>
		<p class="delta">De GSV bruist van leuke activiteiten en clich&eacute;beschrijvingen die niemand leest. Geef je op en kom langs!</p>

		<div class="main-content">
			<div class="event-container">
				@if (1 == 2)
				<h2>Vandaag</h2>
				<div class="event-row">
					<div class="img"><img src="{{ $events[0]->image() }}"  alt="{{ $events[0]->title }}"></div>
					<p class="time">
						<span class="dag">{{ $events[0]->day() }}</span>
						<span class="datum">{{ $events[0]->date() }}</span>
						<span class="tijd">{{ $events[0]->time() }}</span>
					</p>
					<div class="info">
						<h2><a href="{{ route('show_event', $events[0]->id) }}">{{ $events[0]->title}}</a></h2>
						<p>{{ $events[0]->description }}</p>
					</div>
				</div>

				<h2>Deze week</h2>
				<div class="event-row">
					<div class="img"><img src="{{ $events[0]->image() }}"  alt="{{ $events[0]->title }}"></div>
					<!-- <p class="time">
						<span class="dag">{{ $events[0]->day() }}</span>
						<span class="datum">{{ $events[0]->date() }}</span>
						<span class="tijd">{{ $events[0]->time() }}</span>
					</p> -->
					<div class="info">
						<h2><a href="{{ route('show_event', $events[0]->id) }}">{{ $events[0]->title}}</a></h2>
						<p>{{ $events[0]->description }}</p>
					</div>
				</div>
				@endif

				<h2>Komende activiteiten</h2>

				@foreach ($events as $event)
					<div class="event-row">
						<div class="img"><img src="{{ $event->image() }}"  alt="{{ $event->title }}"></div>
						<!-- <p class="time">
							<span class="dag">{{ $event->day() }}</span>
							<span class="datum">{{ $event->date() }}</span>
							<span class="tijd">{{ $event->time() }}</span>
						</p> -->
						<div class="info" style="width:auto;">
							<h2><a href="{{ route('show_event', $event->id) }}">{{ $event->title}}</a></h2>
							<p>{{ $event->description }}</p>
							<!-- <small>Van maandag 10 maart 20:00 tot 22:00</small> -->
							<small>{{{ $event->hoi() }}}</small>
						</div>
					</div>
				@endforeach

			</div>

			{{ $events->links() }}
		</div>
		<div class="secondary-column">
			<h2>2012 | 2013 | 2014</h2>
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