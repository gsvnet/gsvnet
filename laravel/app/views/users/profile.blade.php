@section('content')
	<div class="column-holder">
		<h1>{{{ $member->full_name }}}</h1>
		@if($member->wasOrIsMember())
			<p>{{{$member->profile->yearGroup->name}}} - {{{$member->profile->region_name}}}</p>
		@endif

		<div class="secondary-column">
			<p>{{ $member->profile->photo }}</p>
		</div>
		<div class="main-content">
			<div class="content-columns">
				<div class="content-column with-padding">
					<h2>Account</h2>

                    <ul class="unstyled-list title-description-list">
                        <li>
                            <span class="list-title">Gebruiksnaam</span>
                            <span class="list-description">{{{$member->username}}}</span>
                        </li>
                        <li>
                            <span class="list-title">Email</span>
                            <span class="list-description">{{{$member->email}}}</span>
                        </li>
                        <li>
                            <span class="list-title">Op de site sinds</span>
                            <span class="list-description">{{{$member->registeredSince}}}</span>
                        </li>
                    </ul>
					
				</div>
				<div class="content-column">
					{{-- Show committees --}}
					@if(count($committees) > 0)
						<h2>Commissies</h2>
						<ul class="unstyled-list title-description-list">
							@foreach ($committees as $committee)
								<li>
									<span class="list-title">{{ link_to_action('AboutController@showCommittee', $committee->name, [$committee->unique_name]) }}</span>
									<span class="list-description">{{{$committee->from_to}}}</span>
								</li>
							@endforeach
						</ul>
					@else
						<p>Geen commissies</p>
					@endif
				</div>
			</div>

			@if(Auth::check() && Auth::user()->id == $member->id)
				<p>{{ link_to_action('UserController@editProfile', 'Bewerk je profiel', [], ['class'=>'button']) }}</p>
			@endif
		</div>
	</div>

	<div class="column-holder">

	</div>
@stop