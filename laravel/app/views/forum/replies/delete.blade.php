@extends('layouts.default')

@section('content')
<div class="column-holder">

    <div class="main-content">
        <div class="reply-form">
            <h1>Je reactie verwijderen?</h1>
            {{ Form::model($reply->resource) }}
                <div class="form-row">
                    <p><label class="field-title">Weet je het zeker?</label></p>
                </div>

                <div class="form-row">
                    <p>{{ Form::button('Delete', ['type' => 'submit', 'class' => 'button']) }}</p>
                </div>
        </div>
    </div>
    <div class="secondary-column">
        @include('forum._sidebar')
    </div>
</div>
@stop