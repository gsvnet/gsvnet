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
        @can('threads.show-private')
            <h2>Forumstatistieken</h2>
            <p><a href="{{ URL::action('ForumThreadsController@statistics') }}" title="Toplijsten forumposters">Vind je hier</a></p>
        @endcan

        <h2>Tiende Lustrum der GSV</h2>
        <div id="lustrum-countdown" class="lustrum-countdown"></div>
        <script type="text/template" id="lustrum-countdown-template">
            <div class="time %label%">
                <span class="count curr top">%curr%</span>
                <span class="count next top">%next%</span>
                <span class="count next bottom">%next%</span>
                <span class="count curr bottom">%curr%</span>
                <span class="label">%label%</span>
            </div>
        </script>

        @if(count($events) > 0)
            @can('events.show-private')
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
            @endcan
        @endif

        <h2>Sponsors</h2>
        <p>
            <a href="https://partnerprogramma.bol.com/click/click?p=1&amp;t=url&amp;s=33791&amp;f=TXL&amp;url=http%3A%2F%2Fwww.bol.com&amp;name=GSV-tekstadvertentie" title="Bol.com" class="button">Bol.com</a>
        </p>
        <p>
            <a href="http://www.sponsorkliks.com/winkels.php?club=5241" title="Sponsorkliks" class="button">Sponsorkliks</a>
        </p>
    </div>
</div>

