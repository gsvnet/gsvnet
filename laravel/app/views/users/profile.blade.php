@section('content')
	<div class="column-holder">
		<h1>{{{ $member->present()->fullName }}}</h1>
		@if( isset($member->profile) )
			<p>
				Lid van 
				@if( isset($member->profile->yearGroup) )
					{{ link_to_action('UserController@showUsers', $member->profile->yearGroup->present()->nameWithYear, ['yeargroup' => $member->profile->yearGroup->id]) }} en 
				@endif
				{{ link_to_action('UserController@showUsers', $member->profile->present()->regionName, ['region' => $member->profile->region]) }}
			</p>

		<div class="secondary-column">
			<p>{{ $member->profile->present()->xsmallProfileImage }}</p>

			<h2>Adresgegevens</h2>
			<address>
				{{{ $member->present()->fullName }}} <br>
				{{{ $member->profile->address }}} <br>
				{{{ $member->profile->zip_code }}} {{{ $member->profile->town }}}
			</address>
		</div>
		@endif
		<div class="main-content">
			<div class="content-columns">
				<div class="content-column with-padding">
					<h2>Gegevens</h2>

					<ul class="unstyled-list title-description-list">
						<li>
							<span class="list-title">Lid?</span>
							<span class="list-description">{{{$member->present()->membershipType}}}</span>
						</li>
						<li>
							<span class="list-title">Gebruiksnaam</span>
							<span class="list-description">{{{$member->username}}}</span>
						</li>
						<li>
							<span class="list-title">Email</span>
							<span class="list-description">{{HTML::mailto($member->email)}}</span>
						</li>

						@if( isset($member->profile) )
							<li>
								<span class="list-title">Telefoonnummer</span>
								<span class="list-description"><a href="tel:{{{$member->profile->phone}}}" title="Bel {{{$member->firstname}}}">{{{$member->profile->phone}}}</a></span>
							</li>
							<li>
								<span class="list-title">Geboortedatum</span>
								<span class="list-description">{{{$member->profile->present()->birthdayWithYear}}}</span>
							</li>
							<li>
								<span class="list-title">Geslacht</span>
								<span class="list-description">{{{$member->profile->present()->genderLocalized}}}</span>
							</li>
							<li>
								<span class="list-title">Kerkgezindte</span>
								<span class="list-description">{{{$member->profile->church}}}</span>
							</li>
							<li>
								<span class="list-title">Studie</span>
								<span class="list-description">{{{$member->profile->study}}}</span>
							</li>
							<li>
								<span class="list-title">Studentennummer</span>
								<span class="list-description">{{{$member->profile->student_number}}}</span>
							</li>
						@endif
					</ul>
					@if( isset($member->profile) )
						<h2>Gegevens ouders</h2>

						<ul class="unstyled-list title-description-list">
							<li>
								<span class="list-title">Adres</span>
								<address>
									{{{ $member->profile->parent_address }}} <br>
									{{{ $member->profile->parent_zip_code }}} {{{ $member->profile->parent_town }}}
								</address>
							</li>
							<li>
								<span class="list-title">Telefoon</span>
								<span class="list-description"><a href="tel:{{{$member->profile->parent_phone}}}" title="Bel de ouders van {{{$member->firstname}}}">{{{$member->profile->parent_phone}}}</a></span>
							</li>
						</ul>
					@endif
				</div>
				<div class="content-column">
					@if(count($senates) > 0)
						<h2>Senaat</h2>
						<ul class="unstyled-list title-description-list">
							@foreach ($senates as $senate)
								<li>
									<span class="list-title">{{ link_to_action('AboutController@showSenate', $senate->present()->nameWithYear, [$senate->id], ['title' => 'Meer informatie over Senaat ' . $senate->name]) }}</span>
									<span class="list-description">{{ $senate->senateFunction }}</span>
								</li>
							@endforeach
						</ul>
					@endif
					{{-- Show committees --}}
					@if(count($committees) > 0)
						<h2>Commissies</h2>
						<ul class="unstyled-list title-description-list">
							@foreach ($committees as $committee)
								<li>
									<span class="list-title">{{ link_to_action('AboutController@showCommittee', $committee->name, [$committee->unique_name], ['title' => 'Informatie over de ' . $committee->name]) }}</span>
									<span class="list-description">{{{$committee->present()->from_to}}}</span>
								</li>
							@endforeach
						</ul>
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