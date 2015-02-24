@extends('layouts.default')

@section('title', 'Reactie bewerken')
@section('description', 'Reactie bewerken')

@section('content')
<div class="column-holder">
    <div class="header">
        <h1>Bewerk je reactie</h1>
    </div>

    <div class="main-content">
        {!! Former::open()->action(action('ForumRepliesController@postEditReply', [$reply->id])) !!}
        {!! Former::populate($reply) !!}
        {!! Former::textarea('body')->label('Reactie')->placeholder('Reactie')->rows(10) !!}

        <div class="control-group">
            <input type="submit" value="Bewerk" class="button">
        </div>

        {!! Former::close() !!}
    </div>
    <div class="secondary-column">
        @include('forum._sidebar')
    </div>
</div>
@stop