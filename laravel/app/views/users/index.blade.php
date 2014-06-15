@section('content')
	<div id="user-list" class="column-holder">
		<h1>Jaarbundel</h1>
		<p class="delta">Ben je stiekem vergeten hoe die sjaars heet? Vind het hier</p>
		<div class="secondary-column">
			<h2 id="user-search-form-toggler">Zoek een GSV'er <span></span></h2>
			{{Form::open(array('method'=>'get', 'id' => 'user-search-form'))}}
			<div class="form-group">
				<label class="control-label" for="name">Zoekterm</label>
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
						<option value="{{{$yearGroup->id}}}" {{{Input::get('yeargroup') == $yearGroup->id ? 'selected="selected"' : ''}}}>{{{$yearGroup->present()->nameWithYear}}}</option>
					@endforeach
				</select>
			</div>

			<div class="form-group">
				<button type="submit" class="button">Zoeken #yolo</button>
			</div>
			{{Form::close()}}
		</div>
		<div class="main-content">
			@if(count($members) > 0)
				<ul class="user-profile-list list">
				@foreach ($members as $member)
					@include('users._profile')
				@endforeach
			</ul>
			@else
				<p>Geen gebruikers gevonden</p>
			@endif
		</div>
	</div>

	<div class="column-holder">
		{{ $members->appends(Input::except(array('page')))->links() }}
	</div>
@stop