@extends('layouts.admin')

@section('content')
    <h2>Bewerk commissieactiviteit <small>van {{$member->present()->fullName}} in {{$committee->name}}</small></h2>

    {!! Former::vertical_open()
            ->action(action('Admin\Committees\MembersController@update', $membership->id))
            ->method('PUT') !!}
        {!! Former::populateField('start_date', $membership->present()->startSanitized) !!}
        {!! Former::populateField('end_date', $membership->present()->endSanitized) !!}
        {!! Former::populateField('currently_member', !$membership->end_date ? '1' : '0') !!}

        {!! Former::hidden('committee_id')->value($committee->id) !!}
        {!! Former::hidden('member')->value($member->id) !!}
        {!! Former::date('start_date')->label('Geïnstalleerd op')->help('jjjj-mm-dd')->required() !!}
        {!! Former::checkbox('currently_member')->value('1')->text('Momenteel actief?')->label(null)->checked(false); !!}
        {!! Former::date('end_date')->label('Gedechargeerd op')->help('jjjj-mm-dd. Je mag dit veld leeg laten als degene nog niet gedechargeerd is') !!}
        {!! Former::hidden('member_id')->id('add-user-id')!!}
        <button type='submit' class='btn btn-success'>
            <i class="glyphicon glyphicon-ok"></i> Opslaan
        </button>

        <a class='btn btn-default' href="{{ URL::previous() }}">Terug</a>

        {!! Former::close()!!}
    <hr>

    <p>Of verwijder dit commissiewerk.</p>

    {!! Former::inline_open()
        ->action(action('Admin\Committees\MembersController@destroy', $membership->id))
        ->method('DELETE') !!}
        <button type='submit' class='btn btn-danger'>
            <i class="glyphicon glyphicon-trash"></i> Verwijderen
        </button>

    {!! Former::close() !!}
@stop

@section('javascripts')
    @parent

    <script>
    $('.btn-danger').click( function() {
        return confirm('Zeker weten?');
    });
    </script>
@stop