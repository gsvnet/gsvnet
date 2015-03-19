@extends('layouts.default')

@section('title', 'Inloggen op GSVnet')
@section('description', 'Inloggen om bij het forum te komen')

@section('content')
	<div class="column-holder">
		{!! Former::open()->action(action('SessionController@postLogin')) !!}
	    <p>Inloggen geeft je toegang tot het forum</p>

		@include('partials._login')

	    <div class="form-group">
	        <button type="submit" class="button">Log in</button>
	    </div>
		{!! Former::close() !!}
	</div>
@stop