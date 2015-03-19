@extends('layouts.default')

@section('title', 'Jaarbundel GSV')
@section('description', 'Alle informatie van GSV\'ers is hier te vinden')
@section('body-id', 'user-list-page')

@section('content')
	<div id="user-list" class="column-holder">
		<h1>Jaarbundel</h1>
		<p class="delta">Ben je stiekem vergeten hoe die sjaars heet? Vind het hier</p>
		<div class="secondary-column">
			<h2 id="user-search-form-toggler">Zoek een GSV'er <span></span></h2>
			{!! Form::open(array('method'=>'get', 'id' => 'user-search-form')) !!}
			<div class="form-group">
				<label class="control-label" for="naam">Zoekterm</label>
				<input type="search" class="form-control search-user-input" id="naam" name="naam" placeholder="typ maar gewoon iets" value="{{{Input::get('name', '')}}}">
			</div>
			<div class="form-group">
				<label class="control-label" for="regio">Regio</label>
				<select name="regio" id="regio">
					<option value="0">Maakt niet uit</option>
					@foreach ($regions as $key => $region)
						<option value="{{$key}}" {{Input::get('regio') == $key ? 'selected="selected"' : ''}}>{{$region}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label class="control-label" for="jaarverband">Jaarverband</label>
				<select name="jaarverband" id="jaarverband">
					<option value="0">Doet er niet toe</option>
					@foreach ($yearGroups as $yearGroup)
						<option value="{{$yearGroup->id}}" {{Input::get('jaarverband') == $yearGroup->id ? 'selected="selected"' : ''}}>{{$yearGroup->present()->nameWithYear}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
			    <label><input type="checkbox" name="oudleden" value="1" {{Input::get('oudleden') == 1 ? 'checked="checked"' : ''}} /> Oudleden weergeven</label>
			</div>

			<div class="form-group">
				<button type="submit" class="button">Zoeken #yolo</button>
			</div>
			{!! Form::close() !!}
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
		{!! $members->appends(Input::except(array('page')))->render() !!}
	</div>
@stop