{!! Former::vertical_open()->id('forummessage-form') !!}
@include('forum._editor')
<div id="forum-editor-controls">
    <div class="control-group">
        <input type="submit" id="submit-reply" value="Reageer" class="button float-right">
        <a href="{{ URL::action('ForumThreadsController@getIndex') }}" title="Terug naar de laatste topics" class="button disabled">&laquo; Terug</a>
    </div>
</div>
{!! Former::close() !!}