@extends('layouts.admin')

@section('content')
    <div class="page-header">
        <h1>Novieten</h1>
    </div>

	<div class="table-responsive">
        <table class="table table-striped table-hover sort-table">
            <thead>
                <tr>
                    <th>Gebruikersnaam</th>
                    <th>Voornaam</th>
                    <th>t/v</th>
                    <th>Achternaam</th>
                    <th>Email</th>
                    <th>Aanmelddatum</th>
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
                    <td class="text-muted">{{ $user->created_at }}</td>
                    <td>

                        @if (! $user->approved && Gate::allows('users.manage'))
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

                        @if ($user->isPotential() && Gate::allows('users.manage'))
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
@stop