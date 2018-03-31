@extends('layouts.default')

@section('title', 'De GSV')
@section('description', 'De GSV is een christelijke studentenvereniging met een gereformeerde basis. Ze heeft zo\'n 200 leden die wekelijks bijeen komen voor bijbelstudie een biertje op soos.')
@section('body-id', 'about-page')

@section('content')
  <div class="column-holder">
      <h2>April</h2>
      <p class="delta">Initialiseer de aprilkolom</p>
      <div class="main-content">
          {!! Former::open()->action(URL::action('AprilController@initialise')) !!}
              <div class="form-group">
                  <button type="submit" class="button">Initialiseer</button>
              </div>
          {!!Former::close()!!}
      </div>
  </div>
@stop
