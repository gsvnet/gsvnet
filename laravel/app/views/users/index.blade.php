@section('content')
	<div id="user-list" class="column-holder">
		<div class="main-content">
			<h1>Jaarbundel</h1>
			<ul class="user-profile-list">
			@foreach ($members as $member)
				<li class="user-profile-item">
					<div class="profile-image">

					</div>
					<h3>{{ link_to_action('UserController@showUser', $member->full_name, array($member->id, 'class' => 'search-users')) }}</h3>
					@if($member->profile && $member->profile->yearGroup)
						<ul class="user-details-list">
							<li><i class="fa fa-share"></i> {{{$member->email}}}</li>
							<li class="phone"><i class="fa fa-phone"></i> {{{$member->profile->phone}}}</li>
							<li><span class="dot-after">{{{$member->profile->yearGroup->name}}}</span> Regio {{{$member->profile->region}}}</li>
						</ul>
					@else
						<p><em>Gebruiker heeft geen profiel</em></p>
					@endif
				</li>
			@endforeach
			</ul>
		</div>
		<div class="secondary-column">
			{{Form::open(array('method'=>'get'))}}
			<h2>Zoek een GSV'er</h2>
			<div class="form-group">
				<label class="control-label" for="name">Naam</label>
				<input type="search" class="form-control search-user-input" id="name" name="name" placeholder="typ maar gewoon iets" value="{{{Input::get('name', '')}}}">
			</div>
			<div class="form-group">
				<label class="control-label" for="region">Regio</label>
				<select name="region" id="region">
					<option value="0"></option>
					@foreach ($regions as $key => $region)
						<option value="{{{$key}}}" {{{Input::get('region') == $key ? 'selected="selected"' : ''}}}>{{{$region}}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label class="control-label" for="yeargroup">Jaarverband</label>
				<select name="yeargroup" id="yeargroup">
					<option value="0"></option>
					@foreach ($yearGroups as $yearGroup)
						<option value="{{{$yearGroup->id}}}" {{{Input::get('yeargroup') == $yearGroup->id ? 'selected="selected"' : ''}}}>{{{$yearGroup->name}}}</option>
					@endforeach
				</select>
			</div>

			<div class="form-group">
				<button type="submit" class="button">Zoeken #yolo</button>
			</div>
			{{Form::close()}}
		</div>
	</div>

	<div class="column-holder">
		{{ $members->links() }}
	</div>

@stop