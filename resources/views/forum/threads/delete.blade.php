@extends('layouts.default')

@section('title', 'Topic verwijderen?')
@section('description', 'Topic verwijderen?')

@section('content')
<div class="column-holder">

    <div class="header">
        <h1>Onderwerp verwijderen?</h1>
    </div>

    <div class="main-content has-border-bottom">
        <div class="forum-editor-form">
            {!! Form::model($thread, ['method' => 'delete']) !!}
                <div class="form-row">
                    <label class="field-title">Weet je het heel zeker?</label>
                </div>

                <div class="form-row">
                    {!! Form::button('Weg ermee!', ['type' => 'submit', 'class' => 'button']) !!}
                </div>
        </div>
    </div>
    <div class="secondary-column">
        @include('forum._sidebar')
    </div>
</div>
@stop
