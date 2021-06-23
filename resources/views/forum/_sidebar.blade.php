<div class="content-columns">
    <div class="content-column">
        <h2>Countdown tot elfde lustrum</h2>
        <div id="flipdown" class="flipdown"></div>
        <br>

        <h2>Maak een nieuw topic</h2>
        <p>
            <a class="button" href="{{ action('ForumThreadsController@getCreateThread') }}" rel="nofollow">Nieuw topic</a>
        </p>

        <div class="search">
            <h2>Het forum doorzoeken</h2>
            {!! Former::open()->action(action('ForumThreadsController@getSearch'))->method('get') !!}
            {!! Former::text('query')->placeholder('Zoeken op het forum')->label(false) !!}
            {!! Former::checkbox('replies', 'Doorzoek ook de berichten') !!}
            {!! Former::close() !!}
        </div>
    </div>
    <div class="content-column">
        @can('threads.show-internal')
            <h2>Forumstatistieken</h2>
            <p><a href="{{ URL::action('ForumThreadsController@statistics') }}" title="Toplijsten forumposters">Vind je hier</a></p>
        @endcan

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

        @if (Auth::check() and Auth::user()->isMember())
            <hr>
            <div class="content-column">
                <h2>Verjaardagen</h2>
                <ul class="unstyled-list title-description-list">
                    @if ($birthdays->count())
                        @foreach ($birthdays as $profile)
                            <li>
                                <span class="list-title">
                                    @can('users.show')
                                        {!! link_to_action('UserController@showUser', $profile->user->present()->fullName, $profile->user->id) !!}
                                    @else
                                        {{ $profile->user->present()->fullName }}
                                    @endcan
                                </span>
                                <time class="list-description grey">{{ $profile->present()->birthday }}</time>
                            </li>
                        @endforeach
                    @else
                        <li>Geen verjaardagen deze week.</li>
                    @endif
                </ul>
            </div>
        @endif

        <hr>
        <h2>Sponsors</h2>
        <p>
            <a href="https://partnerprogramma.bol.com/click/click?p=1&amp;t=url&amp;s=33791&amp;f=TXL&amp;url=http%3A%2F%2Fwww.bol.com&amp;name=GSV-tekstadvertentie" title="Bol.com" class="button">Bol.com</a>
        </p>
        <p>
            <a href="http://www.sponsorkliks.com/winkels.php?club=5241" title="Sponsorkliks" class="button">Sponsorkliks</a>
        </p>
    </div>
</div>

