@extends('layouts.admin')

@section('content')
    <div class="page-header">
        <h1>Pas naam aan van <strong>{{ $user->present()->fullName }}</strong></h1>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-6">
            <h2>Naam aanpassen</h2>

            {!! Former::vertical_open()->action(action('Admin\MemberController@updateName', $user->id))->method('PUT') !!}
            {!! Former::populate( $user ) !!}
            {!! Former::populateField('initials', $user->profile->initials) !!}

            {!! Former::text('initials')->label('Initialen') !!}
            {!! Former::text('firstname')->label('Voornaam') !!}
            {!! Former::text('middlename')->label('Tussenvoegsel') !!}
            {!! Former::text('lastname')->label('Achternaam') !!}

            <button type='submit' class='btn btn-success'>
                <i class="glyphicon glyphicon-ok"></i> Opslaan
            </button>

            <a class='btn btn-default' href="{{ URL::previous() }}">Terug</a>
            {!! Former::close() !!}
        </div>
    </div>
@stop