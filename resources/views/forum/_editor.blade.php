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
<div id="forum-editor-form">
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="schrijven">
            {!! Former::textarea('body')->placeholder('Tekst')->label('Bericht')->rows(10) !!}
            @if(Auth::check())
                <p class="imgur-upload">
                    <label for="imgur-file-upload" class="control-label">
                        <svg width="20" height="20" style="vertical-align: text-bottom" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M896 672q119 0 203.5 84.5t84.5 203.5-84.5 203.5-203.5 84.5-203.5-84.5-84.5-203.5 84.5-203.5 203.5-84.5zm704-416q106 0 181 75t75 181v896q0 106-75 181t-181 75h-1408q-106 0-181-75t-75-181v-896q0-106 75-181t181-75h224l51-136q19-49 69.5-84.5t103.5-35.5h512q53 0 103.5 35.5t69.5 84.5l51 136h224zm-704 1152q185 0 316.5-131.5t131.5-316.5-131.5-316.5-316.5-131.5-316.5 131.5-131.5 316.5 131.5 316.5 316.5 131.5z"/></svg>
                        (<span id="imgur-help-text">klik of sleep</span>)
                    </label>
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
                <div id="markdown-preview" class="body"></div>
            </div>
        </div>
    </div>
</div>

