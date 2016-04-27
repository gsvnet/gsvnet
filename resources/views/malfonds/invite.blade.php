@extends('layouts.admin')

@section('content')
    <div class="page-header">
        <h1>Uitnodiging versturen aan <strong>{{ $member->present()->fullName() }}</strong></h1>
    </div>
    <div class="spacer row">
        <div class="col-xs-12 col-md-6">
            <h2>Optie 1: Link opvragen</h2>
            @if ($token)
                <p><input type="text" class="form-control" value="{{$token->present()->url()}}" onclick="this.select()" readonly='readonly'></p>
                <p>Verloopt <strong>{{$token->expires_on->diffForHumans()}}</strong></p>
            @endif

            {!! Former::vertical_open()->action(action('Malfonds\InvitationController@store', $member->id))->method('POST') !!}
            {!! Former::submit()->value('Link opvragen')->class('btn btn-primary') !!}
            {!! Former::close() !!}
        </div>
        <div class="col-xs-12 col-md-6">
            <h2>Optie 2: Uitnodiging versturen per email</h2>
            {!!  Former::vertical_open()->action(action('Admin\MemberController@updateRegion', $member->id))->method('POST') !!}

            {!! Former::email()->label('Email') !!}

            {!! Former::submit()->class('btn btn-primary') !!}
            {!! Former::close() !!}
        </div>
    </div>
@stop