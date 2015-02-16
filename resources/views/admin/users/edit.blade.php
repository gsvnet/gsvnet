@extends('layouts.admin')

@section('content')
    <h1>Gegevens van {{ $user->present()->fullName }} bewerken</h1>
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <h2>Accountgegevens bewerken</h2>

            {!!
                Former::vertical_open()
                    ->action(action('Admin\UsersController@update', $user->id))
                    ->method('PUT')
            !!}
            {!! Former::populate( $user ) !!}

                @include('admin.users._form')

                <button type='submit' class='btn btn-success'>
                    <i class="glyphicon glyphicon-ok"></i> Accountgegevens opslaan
                </button>

                <a class='btn btn-default' href="{{ URL::previous() }}">Terug</a>

            {!! Former::close() !!}
        </div>
        <div class="col-xs-12 col-md-6">
            <h2>Profielgegevens bewerken</h2>
            @if ($profile)
                {!!
                    Former::vertical_open()
                        ->action(action('Admin\UsersController@updateProfile', $user->id))
                        ->method('PUT')
                !!}
                {!! Former::populate( $profile ) !!}
                    @include('admin.users._profile')

                    <button type='submit' class='btn btn-success'>
                        <i class="glyphicon glyphicon-ok"></i> Profiel bijwerken
                    </button>

                    <a class='btn btn-default' href="{{ URL::previous() }}">Terug</a>

                {!! Former::close() !!}
            @else
                {!!
                    Former::inline_open()
                      ->action(action('Admin\UsersController@storeProfile', $user->id))
                      ->method('POST')
                !!}
                    <button type='submit' class='btn btn-success'>
                        <i class="glyphicon glyphicon-plus"></i> Maak GSV-profiel aan
                    </button>

                {!! Former::close(); !!}
            @endif
        </div>
    </div>

    <hr>

    <p>Profiel alleen</p>

    {!!
        Former::open()
          ->action(action('Admin\UsersController@destroyProfile', $user->id))
          ->method('DELETE')
    !!}
        <button type='submit' class='btn btn-danger'>
            <i class="glyphicon glyphicon-trash"></i> Verwijderen zijn profiel alleen
        </button>

    {!! Former::close(); !!}

    <hr>       

    <p>Verwijder de gebruiker.</p>     

    {!!
        Former::open()
          ->action(action('Admin\UsersController@destroy', $user->id))
          ->method('DELETE')
    !!}
        <button type='submit' class='btn btn-danger'>
            <i class="glyphicon glyphicon-trash"></i> Verwijder complete gebruiker
        </button>

    {!!
        Former::close();
    !!}
@stop

@section('javascripts')
    @parent

    <script>
    $('.btn-danger').click( function() {
        return confirm('Zeker weten?');
    });
    </script>
@stop