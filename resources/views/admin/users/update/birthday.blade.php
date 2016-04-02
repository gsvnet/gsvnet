@extends('layouts.admin')

@section('content')
    <div class="page-header">
        <h1>Pas geboortedatum aan van <strong>{{ $user->present()->fullName }}</strong></h1>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-6">
            <h2>Naam aanpassen</h2>

            {!! Former::vertical_open()->action(action('Admin\MemberController@updateBirthDay', $user->id))->method('PUT') !!}
            {!! Former::populate( $user ) !!}

            {!! Former::text('birthdate')->class('form-control birthday-picker')->dataValue($user->profile->birthdate)->label('Geboortedatum') !!}

            <button type='submit' class='btn btn-success'>
                <i class="glyphicon glyphicon-ok"></i> Opslaan
            </button>

            <a class='btn btn-default' href="{{ URL::previous() }}">Terug</a>
            {!! Former::close() !!}
        </div>
    </div>
@stop