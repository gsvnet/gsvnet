@extends('layouts.default')

@section('title', 'Reactie verwijderen?')
@section('description', 'Reactie verwijderen?')

@section('content')
<div class="column-holder">

    <div class="main-content">
        <div class="reply-form">
            <h1>Je reactie verwijderen?</h1>
            {!! Form::model($reply, ['method' => 'delete']) !!}
                <div class="form-row">
                    <p><label class="field-title">Weet je het zeker?</label></p>
                </div>

                <div class="form-row">
                    <p>{!! Form::button('Weggooien!', ['type' => 'submit', 'class' => 'button']) !!}</p>
                </div>
        </div>
    </div>
    <div class="secondary-column">
        @include('forum._sidebar')
    </div>
</div>
@stop