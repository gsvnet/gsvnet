@extends('layouts.default')

@section('title', 'Profiel van ' . $member->present()->fullName)
@section('description', 'Informatie over deze persoon')
@section('body-id', 'own-profile-page')

@section('content')
	<div class="column-holder">
		<h1>{{ $member->present()->fullName }}</h1>
		@if( isset($member->profile) )
			<div style='margin: auto auto 1.5em;'>
            <div>
				Lid van 
				@if( isset($member->profile->yearGroup) )
					{!! link_to_action('UserController@showUsers', $member->profile->yearGroup->present()->nameWithYear, ['jaarverband' => $member->profile->yearGroup->id]) !!} en
				@endif
				{!! link_to_action('UserController@showUsers', $member->profile->present()->regionName, ['regio' => $member->profile->user->profile->current_region]) !!}
                
			</div>
            @if(count($formerRegions) > 0)
                <div style='font-style: italic;'>
                    Was lid van {!! $member->profile->present()->formerRegionLinks !!}
                </div>
            @endif
            </div>

            <div class="secondary-column">
                <div class="content-columns">
                    <div class="content-column">
                        <p><img src="{!! $member->profile->present()->xsmallProfileImage !!}" width="102" height="102" alt="Profielfoto" /></p>

						@if(Auth::check() && Auth::user()->id == $member->id)
							<p>{!! link_to_action('UserController@editProfile', 'Bewerk je profiel', [], ['class'=>'button']) !!}</p>
						@endif

                        <h2>Adresgegevens</h2>
                        <address>
                            {{ $member->present()->fullName }} <br>
                            {{ $member->profile->address }} <br>
                            {{ $member->profile->zip_code }} {{ $member->profile->town }}
                        </address>
                    </div>
                    <div class="content-column">
                        <h2>Pa of ma</h2>
                        <ul class="list secondary-menu">
                            @forelse($member->parents as $parent)
                                <li>{!! link_to_action('UserController@showUser', $parent->present()->fullName, [$parent->id]) !!}</li>
                            @empty
                                <li>Onbekend</li>
                            @endforelse
                        </ul>

                        <h2>Kinderen</h2>
                        <ul class="list secondary-menu">
                            @forelse($member->children as $child)
                                <li>{!! link_to_action('UserController@showUser', $child->present()->fullName, [$child->id]) !!}</li>
                            @empty
                                <li>Kinderloos</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        @else
            <div class="secondary-column">
                <div class="content-columns">
                    <div class="content-column">
						@if(Auth::check() && Auth::user()->id == $member->id)
							<p>{!! link_to_action('UserController@editProfile', 'Bewerk je profiel', [], ['class'=>'button']) !!}</p>
						@endif
                    </div>
                </div>
            </div>
		@endif
		<div class="main-content">
			<div class="content-columns">
				<div class="content-column with-padding">
					<h2>Gegevens</h2>

					<ul class="unstyled-list title-description-list">
						<li>
							<span class="list-title">Lid?</span>
							<span class="list-description">{{$member->present()->membershipType}}</span>
						</li>
						<li>
							<span class="list-title">Gebruiksnaam</span>
							<span class="list-description">{{$member->username}}</span>
						</li>
						<li>
							<span class="list-title">Email</span>
							<span class="list-description">{!! HTML::mailto($member->email) !!}</span>
						</li>

						@if( isset($member->profile) )
							<li>
								<span class="list-title">Initialen</span>
								<span class="list-description">{{$member->profile->initials}}</span>
							</li>
							<li>
								<span class="list-title">Telefoonnummer</span>
								<span class="list-description"><a href="tel:{{$member->profile->phone}}" title="Bel {{$member->firstname}}">{{$member->profile->phone}}</a></span>
							</li>
							<li>
								<span class="list-title">Geboortedatum</span>
								<span class="list-description">{{$member->profile->present()->birthdayWithYear}}</span>
							</li>
							<li>
								<span class="list-title">Geslacht</span>
								<span class="list-description">{{$member->profile->present()->genderLocalized}}</span>
							</li>
							<li>
								<span class="list-title">Kerkgezindte</span>
								<span class="list-description">{{$member->profile->church}}</span>
							</li>
							<li>
								<span class="list-title">Studie</span>
								<span class="list-description">{{$member->profile->study}}</span>
							</li>
							<li>
								<span class="list-title">Studentennummer</span>
								<span class="list-description">{{$member->profile->student_number}}</span>
							</li>
						@endif
					</ul>
					@if( isset($member->profile) )
						<h2>Gegevens ouders</h2>

						<ul class="unstyled-list title-description-list">
							<li>
								<span class="list-title">Adres</span>
								<address>
									{{ $member->profile->parent_address }} <br>
									{{ $member->profile->parent_zip_code }} {{ $member->profile->parent_town }}
								</address>
							</li>
							<li>
								<span class="list-title">Telefoon</span>
								<span class="list-description"><a href="tel:{{$member->profile->parent_phone}}" title="Bel de ouders van {{$member->firstname}}">{{$member->profile->parent_phone}}</a></span>
							</li>
							</li>
								<span class="list-title">Email</span>
								<span class="list-description"><a href="mailto:{{$member->profile->parent_email}}" title="Stuur een email naar de ouders van {{$member->firstname}}">{{$member->profile->parent_email}}</a></span>
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
									<span class="list-title">{!! link_to_action('AboutController@showSenate', $senate->present()->nameWithYear, [$senate->id], ['title' => 'Meer informatie over Senaat ' . $senate->name]) !!}</span>
									<span class="list-description">{{ $senate->present()->senateFunction }}</span>
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
									<span class="list-title">{!! link_to_action('AboutController@showCommittee', $committee->name, [$committee->unique_name], ['title' => 'Informatie over de ' . $committee->name]) !!}</span>
									<span class="list-description">{{$committee->present()->from_to}}</span>
								</li>
							@endforeach
						</ul>
					@endif
				</div>
			</div>
		</div>
	</div>

	<div class="column-holder">

	</div>
@stop