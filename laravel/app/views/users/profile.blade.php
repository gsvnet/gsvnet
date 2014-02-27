@section('content')
	<div class="column-holder">
		<h1>{{{ $member->full_name }}}</h1>
		<div class="main-content">
			<h2>Account</h2>
			<ul>
				<li>Gebruikersnaam: {{{$member->username}}}</li>
				<li>Email: {{{$member->email}}}</li>
			</ul>

			@if($member->wasOrIsMember())
				<h2>GSV-profiel</h2>

				@if($member->profile)
					<h3>Curriculum</h3>
					<p>Lid van:</p>
					<ul>
					 	<li>{{{$member->profile->yearGroup->name}}}</li>
					 	<li>{{{$member->profile->region_name}}}</li>
					 </ul>
				@endif


				{{-- Show committees --}}
				@if($member->committees && count($member->committees) > 0)
					<h3>Commissies</h3>
					<ul>
						@foreach ($member->committees as $committee)
							<li>{{ link_to_action('AboutController@showCommittee', $committee->name, [$committee->id]) }} van {{{$committee->pivot->start_date}}} tot {{{$committee->pivot->end_date }}}</li>
						@endforeach
					</ul>
				@endif
			@endif
		</div>

		<div class="secondary-column">
			<h2>Dit is een lekker ding</h2>
			@if(Auth::check() && Auth::user()->id == $member->id)
			<p>{{ link_to_action('UserController@editProfile', 'Bewerk je profiel', [], ['class'=>'button']) }}
			@endif
			</p>
		</div>
	</div>

	<div class="column-holder">

	</div>

@stop