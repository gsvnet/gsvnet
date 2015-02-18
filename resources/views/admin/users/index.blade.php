@extends('layouts.admin')

@section('content')
    <ul class="nav nav-tabs">
        <li class="{!! Request::segment(3) == '' ? 'active' : '' !!}">
            <a href="{!! URL::action('Admin\UsersController@index') !!}">
                <i class='glyphicon glyphicon-user'></i> Alle
            </a>
        </li>

        <li class="{!! Request::segment(3) == 'leden' ? 'active' : '' !!}">
            <a href="{!! URL::action('Admin\UsersController@showMembers') !!}">
                <i class='glyphicon glyphicon-user'></i> Leden
            </a>
        </li>

        <li class="{!! Request::segment(3) == 'oud-leden' ? 'active' : '' !!}">
            <a href="{!! URL::action('Admin\UsersController@showFormerMembers') !!}">
                <i class='glyphicon glyphicon-user'></i> Oud leden
            </a>
        </li>

        <li class="{!! Request::segment(3) == 'novieten' ? 'active' : '' !!}">
            <a href="{!! URL::action('Admin\UsersController@showPotentials') !!}">
                <i class='glyphicon glyphicon-user'></i> Novieten
            </a>
        </li>

        <li class="{!! Request::segment(3) == 'gasten' ? 'active' : '' !!}">
            <a href="{!! URL::action('Admin\UsersController@showGuests') !!}">
                <i class='glyphicon glyphicon-user'></i> Gasten
            </a>
        </li>
    </ul>

	<h2>Lijst met mensen</h2>

	<p>
	    <a href="{!! URL::action('Admin\UsersController@showMembers', ['output' => 'csv']) !!}" class="btn btn-sm btn-primary"><i class="fa fa-download"></i> Exporteer leden</a>
	    <a href="{!! URL::action('Admin\UsersController@showFormerMembers', ['output' => 'csv']) !!}" class="btn btn-sm btn-default"><i class="fa fa-download"></i> Exporteer oud-leden</a>
	</p>

	<div class="table-responsive">
        <table class='table table-striped table-hover sort-table' style="width:auto;">
            <thead>
                <tr>
                    <th>Gebruikersnaam</th>
                    <th>Voornaam</th>
                    <th>tussenvoegsel</th>
                    <th>Achternaam</th>
                    <th>Email</th>
                    <th>Soort</th>
                    <th>Superkrachten</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>
                    <a href="{{ URL::action('Admin\UsersController@show', $user->id) }}" alt="{{ $user->present()->fullName }}">
                        {{ $user->username }}
                    </a>
                    </td>

                    <td>{{ $user->firstname }}</td>
                    <td>{{ $user->middlename }}</td>
                    <td>{{ $user->lastname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->present()->membershipType }}</td>

                    <td>

                        @if (! $user->approved)
                        {!!
                            Former::inline_open()
                              ->action(action('Admin\UsersController@activate', $user->id))
                        !!}
                            <button type='submit' class='btn btn-success btn-xs'>
                                <i class="glyphicon glyphicon-ok"></i> Registratie goedkeuren
                            </button>
                        {!!
                            Former::close()
                        !!}
                        @endif

                        @if ($user->isPotential())
                        {!!
                            Former::inline_open()
                              ->action(action('Admin\UsersController@accept', $user->id))
                              ->style('float: left; margin-right: 1em;')
                        !!}
                            <button type='submit' class='btn btn-warning btn-xs'>
                                <i class="glyphicon glyphicon-ok"></i> Lid installeren
                            </button>
                        {!!
                            Former::close()
                        !!}
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

	{!! $users->render() !!}

    <div class="page-header">
        <h1>Gebruikers</h1>
    </div>
    <p class="delta">Voeg een gebruiker toe of bewerk oude gebruikers</p>

    <a href="{{ URL::action('Admin\UsersController@create') }}" class='btn btn-success'>
        <span class="glyphicon glyphicon-plus"></span>
        Gebruiker toevoegen
    </a>

@stop