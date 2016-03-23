@extends('layouts.admin')

@section('content')
    <div class="page-header">
        <h1>Pas adres van <strong>{{ $user->present()->fullName }}</strong> aan</h1>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-6">
            <h2>Adres aanpassen</h2>

            {!! Former::vertical_open()->action(action('Admin\MemberController@updateContactDetails', $user->id))->method('PUT') !!}
            {!! Former::populate( $user->profile ) !!}

            {!! Former::text('address')->label('Adres') !!}
            {!! Former::text('zip_code')->label('Postcode') !!}
            {!! Former::text('town')->label('Woonplaats') !!}
            {!! Former::text('country')->label('Land') !!}

            <hr>

            {!! Former::text('phone')->label('Telefoon') !!}

            <button type='submit' class='btn btn-success'>
                <i class="glyphicon glyphicon-ok"></i> Opslaan
            </button>

            <a class='btn btn-default' href="{{ URL::previous() }}">Terug</a>
            {!! Former::close() !!}
        </div>
    </div>
@stop