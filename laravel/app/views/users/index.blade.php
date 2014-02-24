@section('content')
	<div id="user-list" class="column-holder">
		<div class="main-content">
			<h1>Jaarbundel</h1>
			@if(count($members) > 0)
				<ul class="user-profile-list">
				@foreach ($members as $member)
					<li class="user-profile-item">
						<div class="profile-image">
							{{ Gravatar::image(Auth::user()->email, 'Profielfoto', array('width' => 120, 'height' => 120)) }}
						</div>
						<div class="user-details">
							<h3>{{ link_to_action('UserController@showUser', $member->user->full_name, array($member->id, 'class' => 'search-users')) }}</h3>
							<ul class="user-details-list">
								<li>
									<i class="fa fa-share"></i> 
									{{ HTML::mailto($member->user->email) }}
								</li>
								<li class="phone">
									<i class="fa fa-phone"></i> 
									<a href="tel:{{{$member->phone}}}" title="Bel {{{$member->user->full_name}}}">{{{$member->phone}}}</a>
								</li>
								<li>
									<span class="dot-after">{{{$member->yearGroup->name or 'Geen jaarverband'}}}</span> 
									Regio {{{$member->region}}}
								</li>
							</ul>
						</div>
					</li>
				@endforeach
			</ul>
			@else
				<p>Geen gebruikers gevonden</p>
			@endif
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
					<option value="0">Maakt niet uit</option>
					@foreach ($regions as $key => $region)
						<option value="{{{$key}}}" {{{Input::get('region') == $key ? 'selected="selected"' : ''}}}>{{{$region}}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label class="control-label" for="yeargroup">Jaarverband</label>
				<select name="yeargroup" id="yeargroup">
					<option value="0">Doet er niet toe</option>
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