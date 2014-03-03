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
				@if(count($member->committees) > 0)
					<h3>Commissies</h3>
					<ul>
						@foreach ($committees as $committee)
							<li>{{ link_to_action('AboutController@showCommittee', $committee->name, [$committee->unique_name]) }} van {{{$committee->from_to}}}</li>
						@endforeach
					</ul>
				@endif
			@endif
		</div>

		<div class="secondary-column">
			<h2>Dit is een lekker ding</h2>
			{{ $member->profile->photo }}
			@if(Auth::check() && Auth::user()->id == $member->id)
			<p>{{ link_to_action('UserController@editProfile', 'Bewerk je profiel', [], ['class'=>'button']) }}
			@endif
			</p>
		</div>
	</div>

	<div class="column-holder">

	</div>
@stop