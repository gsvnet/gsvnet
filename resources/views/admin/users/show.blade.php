@extends('layouts.admin')

@section('content')
    <div class="page-header">
        <h1><img src="{{ $user->present()->avatar(102) }}" width="102" height="102"> {{ $user->present()->fullName }}</h1>

        @can('users.manage')
        {!! Former::inline_open()
            ->action(action('Admin\UsersController@destroy', $user->id))
            ->method('DELETE') !!}
        <button type='submit' class='btn btn-danger'>
            <i class="glyphicon glyphicon-trash"></i> Verwijderen
        </button>

        {!! Former::close() !!}
        @endcan
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-6">
            <h2>Algemene gegevens</h2>
            <dl>
                <dt>Naam</dt>
                <dd>{{ $user->present()->fullName }}</dd>

                <dt>Email</dt>
                <dd>{{ $user->email }}</dd>

                <dt>Type</dt>
                <dd>{{ $user->present()->membershipType }}</dd>

                <dt>Goedgekeurd</dt>
                <dd>{{ $user->approved ? 'Ja' : 'Nee' }}</dd>

                <dt>Geregistreerd</dt>
                <dd>{{$user->created_at}} <em>{{ $user->present()->registeredSince}}</em></dd>
            </dl>
        </div>
    </div>
@stop
