<div class="search">
    {{ Former::open()->action(action('ForumThreadsController@getSearch'))->method('get') }}
    {{ Former::text('query')->placeholder('Zoeken op het forum')->label('Zoeken') }}
    {{ Former::close() }}
</div>

<ul class="secondary-menu">
    {{-- $forumSections is set in the constructor of the ForumController class --}}
    @foreach($forumSections as $sectionTitle => $attributes)
        <li>
            <a {{ isset($attributes['active']) ? 'class="active"' : null  }} href="{{ action('ForumThreadsController@getIndex') }}{{ $attributes['tags'] ? '?tags=' . $attributes['tags'] : '' }}">{{ $sectionTitle }}
<!--                    <span class="new">1</span>-->
            </a>
        </li>
    @endforeach
</ul>
