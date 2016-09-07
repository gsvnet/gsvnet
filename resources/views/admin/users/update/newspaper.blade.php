@extends('layouts.admin')

@section('content')
    <div class="page-header">
        <h1>Geef aan of <strong>{{ $user->present()->fullName }}</strong> de SIC thuis wil ontvangen</h1>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-6">
            <h2>SIC thuis ontvangen</h2>

            {!! Former::vertical_open()->action(action('Admin\MemberController@updateNewspaper', $user->id))->method('PUT') !!}
            {!! Former::populate( $user->profile ) !!}

            {!! Former::select('receive_newspaper')->options(['0' => 'Niet ontvangen', '1' => 'Wel ontvangen'])->label('SIC thuis ontvangen') !!}

            <button type='submit' class='btn btn-success'>
                <i class="glyphicon glyphicon-ok"></i> Opslaan
            </button>

            <a class='btn btn-default' href="{{ URL::previous() }}">Terug</a>
            {!! Former::close() !!}
        </div>
    </div>
@stop