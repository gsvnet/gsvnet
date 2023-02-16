@extends('layouts._forum')

@section('body-id', 'reply-update-page')
@section('title', 'Reactie bewerken')
@section('description', 'Reactie bewerken')

@section('content')
<div class="column-holder">
    <div class="header">
        <h1>Bewerk je reactie</h1>
    </div>
    <div class="main-content" style="padding-top:1em;">
        {!! Former::open()->action(action([\App\Http\Controllers\ForumRepliesController::class, 'postEditReply'], [$reply->id])) !!}
        {!! Former::populate($reply) !!}
        @include('forum._editor')

        <div id="forum-editor-controls">
            <div class="control-group">
                <input type="submit" value="Bewerk" class="button float-right">
            </div>
        </div>

        {!! Former::close() !!}
    </div>
</div>
@stop

@section('javascripts')
    @parent
@endsection