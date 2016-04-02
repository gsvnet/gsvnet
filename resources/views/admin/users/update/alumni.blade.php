@extends('layouts.admin')

@section('content')
    <div class="page-header">
        <h1>Wijzig de reüniststatus van <strong>{{ $user->present()->fullName }}</strong></h1>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-6">
            <h2>Reüniststatus aanpassen</h2>

            {!! Former::vertical_open()->action(action('Admin\MemberController@updateAlumniStatus', $user->id))->method('PUT') !!}
            {!! Former::populate( $user->profile ) !!}

            {!! Former::select('reunist')->options(['0' => 'Niet', '1' => 'Wel'])->label('Wel of niet reünist?') !!}

            <button type='submit' class='btn btn-success'>
                <i class="glyphicon glyphicon-ok"></i> Opslaan
            </button>

            <a class='btn btn-default' href="{{ URL::previous() }}">Terug</a>
            {!! Former::close() !!}
        </div>
    </div>
@stop