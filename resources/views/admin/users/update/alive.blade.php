@extends('layouts.admin')

@section('content')
    <div class="page-header">
        <h1>{{ $user->present()->fullName }}</h1>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-6">
            {!! Former::vertical_open()->action(action([\App\Http\Controllers\Admin\MemberController::class, 'updateAlive'], $user->id))->method('PUT') !!}
            {!! Former::populate( $user->profile ) !!}

            {!! Former::select('alive')->options(['1' => 'In leven', '0' => 'Overleden'])->label('In leven?') !!}

            <button type='submit' class='btn btn-success'>
                <i class="glyphicon glyphicon-ok"></i> Opslaan
            </button>

            <a class='btn btn-default' href="{{ URL::previous() }}">Terug</a>
            {!! Former::close() !!}
        </div>
    </div>
@stop