@extends('layouts.admin')

@section('content')
    <div class="page-header">
        <h1>Natuurlijke ouders van <strong>{{ $user->present()->fullName }}</strong> aan</h1>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-6">
            <h2>Adres van <strong>ouders</strong> aanpassen</h2>

            {!! Former::vertical_open()->action(action([\App\Http\Controllers\Admin\MemberController::class, 'updateParentContactDetails'], $user->id))->method('PUT') !!}
            {!! Former::populate( $user->profile ) !!}

            {!! Former::text('parent_address')->label('Adres') !!}
            {!! Former::text('parent_zip_code')->label('Postcode') !!}
            {!! Former::text('parent_town')->label('Woonplaats') !!}

            <hr>

            {!! Former::text('parent_phone')->label('Telefoon') !!}
            {!! Former::text('parent_email')->label('Emailadres') !!}

            <button type='submit' class='btn btn-success'>
                <i class="glyphicon glyphicon-ok"></i> Opslaan
            </button>

            <a class='btn btn-default' href="{{ URL::previous() }}">Terug</a>
            {!! Former::close() !!}
        </div>
    </div>
@stop