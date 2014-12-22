<div role="tabpanel">
    <ul class="nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a aria-controls="schrijven" role="tab" data-toggle="tab" href="#schrijven">Schrijven</a>
        </li>
        <li role="presentation">
            <a aria-controls="bekijken" role="tab" data-toggle="tab" id="bekijk-knop" href="#bekijken">Bekijken</a>
        </li>
    </ul>
</div>
{{ Former::vertical_open()->id('reply-form') }}
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="schrijven">
            {{ Former::textarea('body')->placeholder('Tekst')->label('Reageer')->rows(10) }}
        </div>
        <div role="tabpanel" class="tab-pane" id="bekijken">
            <div class="loading-indicator">
                Bezig met laden
            </div>
            <div class="_post">
                <div class="forum-post-data">
                    <div class="avatar">
                        {{ $currentUser->present()->avatarDeferred(40) }}
                    </div>
                    <div class="info">
                        <strong class="author">
                            {{{ $currentUser->username }}}
                        </strong>
                        <ul class="inline-list grey">
                            <li>Nu</li>
                        </ul>
                    </div>
                </div>
                <div id="markdown-preview"></div>
            </div>
        </div>
    </div>
    <div class="control-group">
        <input type="submit" id="submit-reply" value="Reageer" class="button float-right">
        <a href="{{ URL::action('ForumThreadsController@getIndex') }}" title="Terug naar de laatste topics" class="button disabled">&laquo; Terug</a>
    </div>
{{ Former::close() }}
