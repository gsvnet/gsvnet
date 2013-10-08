@section('content')
	<div class="column-holder">
		<ul>
		@foreach ($members as $member)
			<li>
				<strong>{{ link_to_route('user-profile', $member->firstname . ' ' . $member->lastname, $parameters = array($member->id)) }}</strong>
				@if($member->profile)
					<p>Telefoon: {{$member->profile->phone}}</p>
					<p>Jaarverband: {{$member->profile->yearGroup->name}}</p>
					<p>Email: {{$member->mail}}</p>
				@else
					<p><em>Gebruiker heeft geen profiel</em></p>
				@endif
			</li>
		@endforeach
		</ul>

		{{ $members->links() }}
	</div>

@stop