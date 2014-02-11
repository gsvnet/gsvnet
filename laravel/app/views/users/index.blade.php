@section('content')
	<div id="user-list" class="column-holder">
		<div class="main-content">
			<ul class="user-profile-list">
			@foreach ($members as $member)
				<li class="user-profile-item">
					<div class="profile-image">

					</div>
					<h3>{{ link_to_action('UserController@showUser', $member->full_name, array($member->id, 'class' => 'search-users')) }}</h3>
					@if($member->profile)
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
				<input type="search" class="form-control search-user-input" id="name" name="name" placeholder="typ maar gewoon iets">
			</div>
			<div class="form-group">
				<label class="control-label" for="region">Regio</label>
				<select name="region" id="region">
					<option value="0"></option>
					<option val="1">Regio 1</option>
					<option val="2">Regio 2</option>
					<option val="3">Regio 3</option>
					<option val="4">Regio IV</option>
				</select>
			</div>
			<div class="form-group">
				<label class="control-label" for="yeargroup">Jaarverband</label>
				<select name="yeargroup" id="yeargroup">
					<option value="0"></option>
					@foreach ($yearGroups as $yearGroup)
						<option value="{{{$yearGroup->id}}}">{{{$yearGroup->name}}}</option>
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

@section('javascripts')
	@parent
	<script src="/javascripts/list.min.js"></script>
	<script src="/javascripts/user-index.js"></script>
@stop