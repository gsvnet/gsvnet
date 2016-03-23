@extends('layouts.admin')

@section('content')
    <div class="page-header">
        <h1>Pas adres van <strong>{{ $user->present()->fullName }}</strong> aan</h1>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-6">
            <h2>Adres aanpassen</h2>

            {!! Former::open_vertical_for_files()->action(action('Admin\MemberController@updatePhoto', $user->id))->method('PUT') !!}

            {!! Former::file('photo_path')->label('Foto') !!}

            <button type='submit' class='btn btn-success'>
                <i class="glyphicon glyphicon-ok"></i> Opslaan
            </button>

            <a class='btn btn-default' href="{{ URL::previous() }}">Terug</a>
            {!! Former::close() !!}
        </div>
    </div>
@stop