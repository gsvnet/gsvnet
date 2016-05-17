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
{!! Former::vertical_open()->id('reply-form') !!}
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="schrijven">
            {!! Former::textarea('body')->placeholder('Tekst')->label('Reageer')->rows(10) !!}
            @if(Auth::check())
                <p class="imgur-upload">
                    <label for="imgur-file-upload" class="control-label">+ Foto (<span id="imgur-help-text">klik of sleep</span>)</label>
                    <input type="file" id="imgur-file-upload" style="display: none" accept="image/*" />
                </p>
            @endif
        </div>
        <div role="tabpanel" class="tab-pane" id="bekijken">
            <div class="loading-indicator">
                Bezig met laden
            </div>
            <div class="_post">
                <div class="forum-post-data">
                    <div class="avatar">
                        {!! Auth::user()->present()->avatarDeferred(40) !!}
                    </div>
                    <div class="info">
                        <strong class="author">
                            {{ Auth::user()->username }}
                        </strong>
                        <ul class="inline-list grey">
                            <li>Nu</li>
                        </ul>
                    </div>
                </div>
                {{-- // TODO: move styling to SASS --}}
                <div id="markdown-preview" style="min-height: 13em;
                        background-color: #FFF;
                        overflow: auto;
                        padding: 0 1.2em;
                        margin: 0 -1em 1em;
                        border: 1px solid #EEE;">
                </div>
            </div>
        </div>
    </div>
    <div class="control-group">
        <input type="submit" id="submit-reply" value="Reageer" class="button float-right">
        <a href="{{ URL::action('ForumThreadsController@getIndex') }}" title="Terug naar de laatste topics" class="button disabled">&laquo; Terug</a>
    </div>
{!! Former::close() !!}

