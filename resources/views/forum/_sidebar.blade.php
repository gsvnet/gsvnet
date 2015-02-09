<div class="content-columns">
    <div class="content-column">
        <h2>Maak een nieuw topic</h2>
        <p>
            <a class="button" href="{{ action('ForumThreadsController@getCreateThread') }}" rel="nofollow">Nieuw topic</a>
        </p>

        <div class="search">
            <h2>Het forum doorzoeken</h2>
            {{ Former::open()->action(action('ForumThreadsController@getSearch'))->method('get') }}
            {{ Former::text('query')->placeholder('Zoeken op het forum')->label(false) }}
            {{ Former::close() }}
        </div>
    </div>
    <div class="content-column">
        @if( Permission::has('threads.show-private') )
            <h2>Forumstatistieken</h2>
            <p><a href="{{ URL::action('ForumThreadsController@statistics') }}" title="Toplijsten forumposters" class="button">Toplijsten</a></p>
        @endif
        <h2>Tags</h2>
        <ul class="secondary-menu">
            {{-- $forumSections is set in the constructor of the ForumController class --}}
            @foreach($forumSections as $sectionTitle => $attributes)
                <li>
                    <a {{ isset($attributes['active']) ? 'class="active"' : null  }} href="{{ action('ForumThreadsController@getIndex') }}{{ $attributes['tags'] ? '?tags=' . $attributes['tags'] : '' }}">{{ $sectionTitle }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

