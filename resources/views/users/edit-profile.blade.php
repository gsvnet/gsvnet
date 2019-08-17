@extends('layouts.default')

@section('title', 'Verander je gegevens')
@section('description', 'Verander je gegevens')
@section('body-id', 'edit-profile-page')

@section('content')
    <div class="column-holder">
        <h1>Verander je forumaccount</h1>
        <p class="delta">Wijzig hier je email of wachtwoord.</p>

        @if($errors->count() > 0)
            <div style="padding:1em;background:#FF5F5F">
                <strong>Je hebt iets verkeerd ingevuld!</strong>
                @foreach($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            </div>
        @endif

        {!! Former::open_vertical()->action(action('UserController@updateProfile'))->id('edit-profile-form') !!}
        <div class="main-content">
            {!! Former::populateField('email', Auth::user()->email) !!}

            {!! Former::text('email')->label('Email') !!}

            <p>Laat het wachtwoord leeg om het te laten als het is.</p>
            {!! Former::password('password')->forceValue('')->label('Nieuw wachtwoord') !!}
            {!! Former::password('password_confirmation')->forceValue('')->label('Wachtwoord herhalen') !!}

        </div>
        <div class="secondary-column">
            @if($user->isMemberOrReunist())
                <h2>Wil je je GSV-profiel wijzigen?</h2>
                <p><a href="{{action('Admin\UsersController@show', $user->id)}}" class="button">GSV-profiel wijzigen</a></p>
            @endif
            <h2>Je avatar</h2>
            <p>Je avatar kun je aanpassen op <a href="http://nl.gravatar.com/" title="Je avatar aanpassen">Gravatar</a>.</p>
        </div>
    </div>
    <div class="column-holder">
        <div class="control-group">
            <input type="submit" id="edit-profile-submit" value="Veranderen die hap" class="button">
        </div>
    </div>
    {!! Former::close() !!}
@stop