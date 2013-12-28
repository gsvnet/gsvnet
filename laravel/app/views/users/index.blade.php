@section('content')
	<div class="column-holder">
		<div class="main-content">
			<ul class="user-profile-list">
			@foreach ($members as $member)
				<li class="user-profile-item">
					<div class="profile-image">
						
					</div>
					<h3>{{ link_to_route('user-profile', $member->firstname . ' ' . $member->lastname, $parameters = array($member->id)) }}</h3>
					@if($member->profile)
						<ul class="user-details-list">
							<li><span class="dot-after">{{$member->mail}}</span> {{$member->profile->phone}}</li>
							<li><span class="dot-after">{{$member->profile->yearGroup->name}}</span> Regio 2</li>
						</ul>
					@else
						<p><em>Gebruiker heeft geen profiel</em></p>
					@endif
				</li>
			@endforeach
			</ul>
		</div>
		<div class="secondary-column">
			<h2>Zoek een GSV'er</h2>
		</div>
	</div>

	<div class="column-holder">
		{{ $members->links() }}
	</div>

@stop