@extends('layouts.admin')

@section('content')
    <div class="page-header">
        <h1>Pas regio van <strong>{{ $user->present()->fullName }}</strong> aan</h1>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-6">
            <h2>Regio aanpassen</h2>

            {!! Former::vertical_open()->action(action('Admin\MemberController@updateRegion', $user->id))->method('PUT') !!}
            {!! Former::populate( $user->profile ) !!}

            {!! Former::select('region')->label('')->options(['geen' => 'Geen'] + $regions) !!}

            <button type='submit' class='btn btn-success'>
                <i class="glyphicon glyphicon-ok"></i> Opslaan
            </button>

            <a class='btn btn-default' href="{{ URL::previous() }}">Terug</a>
            {!! Former::close() !!}
        </div>
    </div>
@stop