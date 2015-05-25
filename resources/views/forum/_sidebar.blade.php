<div class="content-columns">
    <div class="content-column">
        <h2>Maak een nieuw topic</h2>
        <p>
            <a class="button" href="{{ action('ForumThreadsController@getCreateThread') }}" rel="nofollow">Nieuw topic</a>
        </p>

        <div class="search">
            <h2>Het forum doorzoeken</h2>
            {!! Former::open()->action(action('ForumThreadsController@getSearch'))->method('get') !!}
            {!! Former::text('query')->placeholder('Zoeken op het forum')->label(false) !!}
            {!! Former::close() !!}
        </div>
    </div>
    <div class="content-column">
        @if( Permission::has('threads.show-private') )
            <h2>Forumstatistieken</h2>
            <p><a href="{{ URL::action('ForumThreadsController@statistics') }}" title="Toplijsten forumposters">Vind je hier</a></p>
        @endif

        @if( Permission::has('events.show-private') && count($events) > 0 )
            <h2>Komende activiteiten</h2>
            <ul class="unstyled-list title-description-list">
                @foreach ($events as $event)
                    <li>
                        <span class="list-title">
                        {!! HTML::link($event->present()->url, $event->title) !!}
                        </span>
                        <time class="list-description grey">{{ $event->present()->from_to_short }}</time>
                    </li>
                @endforeach
            </ul>
        @endif

        <h2>Sponsors</h2>
        <p>
            <a href="http://www.glas.nl/groningen" rel="nofollow" title="Sponsor: Glaszetter Groningen">
                <img src="/images/ads/glaspunt.png" alt="Glaszetter Groningen" width="292" height="219" class="ad-img" />
            </a>
        </p>
    </div>
</div>

