@section('content')
	<div class="column-holder" role="main">
		<h1>Activiteiten, feesten en borrels</h1>
		<p class="delta">De GSV bruist van leuke activiteiten en clich&eacute;beschrijvingen die niemand leest. Geef je op en kom langs!</p>

		<div class="main-content">
			<div class="event-container">

				@foreach ($events as $event)
					<div class="event-row">
						<div class="img"><img src="http://lorempixel.com/126/126?a{{ $event->id }}"  alt="Zus"></div>
						<p class="time">
							<span class="dag">{{ $event->day() }}</span>
							<span class="datum">{{ $event->date() }}</span>
							<span class="tijd">{{ $event->time() }}</span>
						</p>
						<div class="info">
							<h2><a href="#">{{ $event->title}}</a></h2>
							<p>{{ $event->description }}</p>
						</div>
					</div>
				@endforeach

			</div>
			<ul class="pagination">
				<li class="previous disabled"><a href="#">« Later</a></li>
				<li class="active"><a href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li>
				<li class="next"><a href="#">Eerder »</a></li>
			</ul>
		</div>
		<div class="secondary-column">
			<h2>Lorem ipsum dolor sit.</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa id aut voluptas eos sed vel blanditiis maiores sunt inventore nihil.</p>
			<h2>Lorem ipsum dolor sit.</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa id aut voluptas eos sed vel blanditiis maiores sunt inventore nihil.</p>
		</div>
	</div>
@stop