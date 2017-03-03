@extends('layouts.admin')

@section('content')
    <h2>Senaat bewerken</h2>

    {!! Former::vertical_open()
        ->action(action('Admin\SenateController@update', $senate->id))
        ->method('PUT')
    !!}
        {!! Former::populate( $senate ) !!}

        <button type='submit' class='btn btn-success btn-sm pull-right'>
            <i class="glyphicon glyphicon-ok"></i> Opslaan
        </button>

        @include('admin.senates._form')

        <button type='submit' class='btn btn-success'>
            <i class="glyphicon glyphicon-ok"></i> Opslaan
        </button>

        <a class='btn btn-default' href="{{ URL::previous() }}">Terug</a>

        {!! Former::close() !!}
    <hr>

    <p>Of verwijder de senaat.</p>

    {!! Former::inline_open()
        ->action(action('Admin\SenateController@destroy', $senate->id))
        ->method('DELETE')
    !!}
        <button type='submit' class='btn btn-danger'>
            <i class="glyphicon glyphicon-trash"></i> Verwijderen
        </button>

    {!! Former::close() !!}
@stop