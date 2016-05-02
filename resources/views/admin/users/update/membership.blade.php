@extends('layouts.admin')

@section('content')
    <div class="page-header">
        <h1>Pas lidmaatschapstatus aan van <strong>{{ $user->present()->fullName }}</strong></h1>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-6">
            @if ($user->isMember())
                {!! Former::vertical_open()->action(action('Admin\MemberController@makeFormerMember', $user->id))->method('POST') !!}

                <button type='submit' class='btn btn-success'>
                    <i class="glyphicon glyphicon-ok"></i> Oud-lid maken
                </button>

                <a class='btn btn-default' href="{{ URL::previous() }}">Terug</a>
                {!! Former::close() !!}
            @elseif($user->isFormerMember())
                {!! Former::vertical_open()->action(action('Admin\MemberController@makeMember', $user->id))->method('POST') !!}

                <button type='submit' class='btn btn-success'>
                    <i class="glyphicon glyphicon-ok"></i> Lid maken
                </button>

                <a class='btn btn-default' href="{{ URL::previous() }}">Terug</a>
                {!! Former::close() !!}
            @endif
        </div>
    </div>
@stop