@extends('layouts.admin')

@section('content')
    <div class="page-header">
        <h1>Pas periode van lidmaatschap aan van <strong>{{ $user->present()->fullName }}</strong></h1>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-6">
            {!! Former::vertical_open()->action(action('Admin\MemberController@updateMembershipPeriod', $user->id))->method('PUT') !!}

            <h2>Van</h2>
            {!! Former::text('inauguration_date')->class('form-control birthday-picker')->dataValue($user->profile->inauguration_date ?: '')->label('Van') !!}

            <h2>Tot</h2>
            <p>Tip: Je kunt de datum ook verwijderen onderin de datumprikker.</p>
            {!! Former::text('resignation_date')->class('form-control birthday-picker')->dataValue($user->profile->resignation_date ?: '')->label('Tot') !!}

            <button type='submit' class='btn btn-success'>
                <i class="glyphicon glyphicon-ok"></i> Opslaan
            </button>

            <a class='btn btn-default' href="{{ URL::previous() }}">Terug</a>
            {!! Former::close() !!}
        </div>
    </div>
@stop