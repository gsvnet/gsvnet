@section('content')
	<div class="column-holder">
		<h1>{{{ $member->full_name }}}</h1>
		@if($member->wasOrIsMember())
			<p>{{{$member->profile->yearGroup->name}}} - {{{$member->profile->region_name}}}</p>
		@endif

		<div class="secondary-column">
			<p>{{ $member->profile->photo }}</p>
			<h2>Adresgegevens</h2>
			<address>
				{{{ $member->full_name }}} <br>
				{{{ $member->profile->address }}} <br>
				{{{ $member->profile->zip_code }}} {{{ $member->profile->town }}}
			</address>
		</div>
		<div class="main-content">
			<div class="content-columns">
				<div class="content-column with-padding">
					<h2>Wat gegevens</h2>

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
                            <span class="list-title">Telefoonnummer</span>
                            <span class="list-description"><a href="{{{$member->profile->phone}}}">{{{$member->profile->phone}}}</a></span>
                        </li>
                        <li>
                            <span class="list-title">Lid?</span>
                            <span class="list-description">{{{$member->membershipType}}}</span>
                        </li>
                        <li>
                            <span class="list-title">Op de site sinds</span>
                            <span class="list-description">{{{$member->registeredSince}}}</span>
                        </li>
                    </ul>
				</div>
				<div class="content-column">
					@if(count($senates) > 0)
						<h2>Senaat</h2>
						<ul class="unstyled-list title-description-list">
							@foreach ($senates as $senate)
								<li>
									<span class="list-title">{{ link_to_action('AboutController@showSenate', $senate->nameWithYear, [$senate->id]) }}</span>
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
			<div class="content-columns">
				<div class="content-column">
					<h2>Persoonlijke gegevens</h2>

                    <ul class="unstyled-list title-description-list">
                        <li>
                            <span class="list-title">Geboortedatum</span>
                            <span class="list-description">{{{$member->profile->birthdayWithYear}}}</span>
                        </li>
                        <li>
                            <span class="list-title">Geslacht</span>
                            <span class="list-description">{{{$member->profile->genderLocalized}}}</span>
                        </li>
                        <li>
                            <span class="list-title">Kerkgezindte</span>
                            <span class="list-description">{{{$member->profile->church}}}</span>
                        </li>
                        <li>
                            <span class="list-title">Studie</span>
                            <span class="list-description">{{{$member->profile->study}}}</span>
                        </li>
                    </ul>
				</div>
				<div class="content-column">
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
                            <span class="list-description">{{{$member->profile->parent_phone}}}</span>
                        </li>
                    </ul>
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