@extends('layouts.default')

@section('sidebar')
@stop

@section('content')
<div class="column-holder">

    <div class="header">
        <h1>Delete Your Reply?</h1>
    </div>

    <div class="main-content">
        <div class="reply-form">
            {{ Form::model($reply->resource) }}
                <div class="form-row">
                    <label class="field-title">Are you sure that you want to delete this reply?</label>
                </div>

                <div class="form-row">
                    {{ Form::button('Delete', ['type' => 'submit', 'class' => 'button']) }}
                </div>
        </div>
    </div>
    <div class="secondary-column">
        @include('forum._sidebar')
    </div>
</div>
@stop