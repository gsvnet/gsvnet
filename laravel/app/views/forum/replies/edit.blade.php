@extends('layouts.default')

@section('content')
<div class="column-holder">
    <div class="header">
        <h1>Bewerk je reactie</h1>
    </div>

    <div class="main-content">
        {{ Former::open()->action(action('ForumRepliesController@postEditReply', [$reply->id])) }}
        {{ Former::populate($reply->resource) }}
        {{ Former::textarea('body')->label('Reactie')->placeholder('Reactie')->rows(10) }}

        <div class="control-group">
            <input type="submit" value="Bewerk" class="button">
        </div>

        {{ Former::close() }}
    </div>
    <div class="secondary-column">
        @include('forum._sidebar')
    </div>
</div>
@stop