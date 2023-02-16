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
                <p>Verloopt <strong>{{$token->expires_on->diffForHumans()}}</strong>. <a href="{{$token->present()->url()}}">Klikbare link</a></p>
            @endif

            {!! Former::vertical_open()->action(action([\App\Http\Controllers\Malfonds\InvitationController::class, 'store'], $member->id))->method('POST') !!}
            {!! Former::submit()->value('Link opvragen')->class('btn btn-primary') !!}
            {!! Former::close() !!}
        </div>
        <div class="col-xs-12 col-md-6">
            <h2>Optie 2: Uitnodiging versturen per email</h2>
            {!! Former::vertical_open()->action(action([\App\Http\Controllers\Malfonds\InvitationController::class, 'inviteByMail'], $member->id))->method('POST') !!}
            {!! Former::populateField('name', $member->present()->fullName)!!}
            {!! Former::populateField('email', $member->email)!!}

            {!! Former::text('name')->label('Naam') !!}
            {!! Former::email('email')->label('Email') !!}
            {!! Former::select('title')->label('Aanspreektitel')->options(['amice of amica' => 'Amice of amica', 'amice' => 'Amice', 'amica' => 'Amica']) !!}
            {!! Former::textarea('message')->label('Persoonlijk bericht')->rows(6) !!}

            {!! Former::submit()->class('btn btn-primary') !!}
            {!! Former::close() !!}
        </div>
    </div>
@stop