@extends('layouts.admin')

@section('content')
    <div class="page-header">
        <h1>Selecteer welke gegevens van <strong>{{ $user->present()->fullName }}</strong> je wil verwijderen</h1>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-6">
            <h2>Verwijderen</h2>

            {!! Former::vertical_open()->action(action('Admin\MemberController@forget', $user->id))->method('POST') !!}

            {!! Former::checkbox('name')->push(true)->label('')->text('Naam')->check() !!}
            {!! Former::checkbox('username')->push(true)->label('')->text('Gebruikersnaam')->check() !!}
            {!! Former::checkbox('address')->push(true)->label('')->text('Adresgegevens')->check() !!}
            {!! Former::checkbox('email')->push(true)->label('')->text('E-mailadres')->check() !!}
            {!! Former::checkbox('profilePicture')->push(true)->label('')->text('Profielfoto')->check() !!}
            {!! Former::checkbox('birthDay')->push(true)->label('')->text('Geboortedatum')->check() !!}
            {!! Former::checkbox('gender')->push(true)->label('')->text('Geslacht')->check() !!}
            {!! Former::checkbox('phone')->push(true)->label('')->text('Telefoonnummer')->check() !!}
            {!! Former::checkbox('study')->push(true)->label('')->text('Studiegegevens')->check() !!}
            {!! Former::checkbox('business')->push(true)->label('')->text('Werkgegevens')->check() !!}
            {!! Former::checkbox('parents')->push(true)->label('')->text('Gegevens ouders')->check() !!}

            <button type='submit' class='btn btn-danger'>
                <i class="glyphicon glyphicon-trash"></i> Verwijder gegevens
            </button>

            <a class='btn btn-default' href="{{ URL::previous() }}">Terug</a>
            {!! Former::close() !!}
        </div>
    </div>
@stop