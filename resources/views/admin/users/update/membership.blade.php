@extends('layouts.admin')

@section('content')
    <div class="page-header">
        <h1>Pas lidmaatschapstatus aan van <strong>{{ $user->present()->fullName }}</strong></h1>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-6">
            @if ($user->isMember())
                <div class="form-group">
                    {!! Former::vertical_open()->action(action([\App\Http\Controllers\Admin\MemberController::class, 'makeReunist'], $user->id))->method('POST') !!}
                    <button type='submit' class='btn btn-success btn-confirm'>
                        <i class="glyphicon glyphicon-ok"></i> Reünist maken
                    </button>
                    {!! Former::close() !!}
                </div>

                <div class="form-group">
                    {!! Former::vertical_open()->action(action([\App\Http\Controllers\Admin\MemberController::class, 'makeExMember'], $user->id))->method('POST') !!}
                    <button type='submit' class='btn btn-success btn-confirm'>
                        <i class="glyphicon glyphicon-ok"></i> Oud-lid maken
                    </button>
                    {!! Former::close() !!}
                </div>

            @elseif($user->isReunist())
                <div class="form-group">
                    {!! Former::vertical_open()->action(action([\App\Http\Controllers\Admin\MemberController::class, 'makeMember'], $user->id))->method('POST') !!}
                    <button type='submit' class='btn btn-success btn-confirm'>
                        <i class="glyphicon glyphicon-ok"></i> Lid maken
                    </button>
                    {!! Former::close() !!}
                </div>

                <div class="form-group">
                    {!! Former::vertical_open()->action(action([\App\Http\Controllers\Admin\MemberController::class, 'makeExMember'], $user->id))->method('POST') !!}
                    <button type='submit' class='btn btn-success btn-confirm'>
                        <i class="glyphicon glyphicon-ok"></i> Oud-lid maken
                    </button>
                    {!! Former::close() !!}
                </div>
            @endif
            
            <a class='btn btn-default' href="{{ URL::previous() }}">Terug</a>
        </div>
    </div>
@stop