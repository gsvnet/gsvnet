@extends('layouts.default')

@section('content')
<div class="column-holder">

    <div class="header">
        <h1>Delete Your Thread?</h1>
    </div>

    <div class="main-content">
        <div class="reply-form">
            {{ Form::model($thread->resource) }}
                <div class="form-row">
                    <label class="field-title">Are you sure that you want to delete this thread?</label>
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
