{{ Former::vertical_open()->id('reply-form') }}
    {{ Former::textarea('body')->placeholder('Tekst')->label('Reageer')->rows(10) }}
    
    <div class="control-group">
        <input type="submit" id="submit-reply" value="Reageer" class="button right">
        <a href="{{ URL::action('ForumThreadsController@getIndex') }}" title="Terug naar de laatste topics" class="button disabled">&laquo; Terug</a></p>
    </div>
{{ Former::close() }}
