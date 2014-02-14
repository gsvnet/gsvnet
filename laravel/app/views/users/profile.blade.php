@section('content')
	<div class="column-holder">
		<div class="main-content">
			<h1>{{{ $member->full_name }}}</h1>

			@if($member->profile)
			{{{$member->profile->yearGroup->name}}}
			@endif


			{{-- Show committees --}}
			@if($member->committees && count($member->committees) > 0)
				<h2>Commissies</h2>
				<ul>
					@foreach ($member->committees as $committee)
						<li>{{ link_to_action('AboutController@showCommittee', $committee->name, [$committee->id]) }} van {{{$committee->pivot->start_date}}} tot {{{$committee->pivot->end_date }}}</li>
					@endforeach
				</ul>
			@endif
		</div>

		<div class="secondary-column">
			<h2>Dit is een lekker ding</h2>
		</div>
	</div>

	<div class="column-holder">

	</div>

@stop