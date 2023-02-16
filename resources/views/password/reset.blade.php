@extends('layouts.default')

@section('title', 'Nieuw wachtwoord opgeven')
@section('description', 'Nieuw wachtwoord opgeven')

@section('content')
    <div class="column-holder">
        <h1>Wachtwoord resetten</h1>
        <p class="delta">Vul je nieuwe wachtwoord in</p>
        @if (Session::has('error'))
            {{ Session::get('error') }}
        @endif

        {!! Former::open()->action(action([\App\Http\Controllers\RemindersController::class, 'postReset']))!!}
            {!! Former::hidden('token', $token)!!}
            {!! Former::email('email')->label('Je emailadres') !!}
            {!! Former::password('password')->label('Nieuw wachtwoord') !!}
            {!! Former::password('password_confirmation')->label('Nieuw wachtwoord herhalen') !!}

            <div class="form-group">
                <input type="submit" class="button" value="Resetten" />
            </div>
        {!! Former::close() !!}
    </div>
@stop