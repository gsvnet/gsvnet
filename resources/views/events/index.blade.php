@extends('layouts.default')

{{-- pagination in titel! --}}
@if($searchTimeRange)
	@section('title', 'Activiteiten in ' . ($month ? $month . ' ' : '')  . $year)
	@section('description', 'Activiteiten in ' . ($month ? $month . ' ' : '') . $year)
@else
	@section('title', 'Activiteiten van de GSV')
	@section('description', 'Hier is te vinden welke activiteiten de GSV allemaal op haar agenda heeft staan.')
@endif

@section('content')
	<div class="column-holder" role="main">
		<h1>Activiteiten</h1>
		<p class="delta">Bekijk de agenda van de GSV</p>

		@include('events.sidebar')

		<div class="main-content">
			<div class="event-container">
				@if($searchTimeRange)
				<h2>Activiteiten in {{$month}} {{$year}}</h2>
				@else
				<h2>Komende activiteiten</h2>
				@endif

				@if(count($events) == 0)
					<p>Doffe ellende! Niks te doen in deze periode</p>
				@else
					@foreach ($events as $event)
						@include('events._event')
					@endforeach
				@endif
			</div>

			{!! $events->render() !!}
		</div>
	</div>
@stop