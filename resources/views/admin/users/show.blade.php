@extends('layouts.admin')

@section('content')
    <div class="page-header">
        <h1>{!! $user->present()->avatar(102) !!} {{ $user->present()->fullName }}</h1>

        <a href="{{ URL::action('Admin\UsersController@edit', $user->id) }}" alt="Bewerk {{ $user->fullName }}" class='btn btn-default'><i class="fa fa-pencil"></i> Account bewerken</a>
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
            </dl>
        </div>
    </div>
@stop
