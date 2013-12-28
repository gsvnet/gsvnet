@section('content')
	<div class="column-holder">
		<div class="main-content">
			<h1>{{ $member->firstname }} {{ $member->lastname }}</h1>

			@if($member->profile)
			{{$member->profile->yearGroup->name}}
			@endif
			
			
			@if($member->committees && count($member->committees) > 0)
				<h2>Commissies</h2>
				<ul>
					@foreach ($member->committees as $committee)
						<li>{{ link_to_route('show_committee', $committee->name, [$committee->id]) }} van {{$committee->pivot->start_date}} tot {{$committee->pivot->end_date }}</li>
					@endforeach
				</ul>
			@endif

		</div>
		
		<div class="secondary-column">
			<h2>;D</h2>
		</div>
	</div>

	<div class="column-holder">
		
	</div>

@stop