<div class="thread _post" data-author-name='{{ json_encode($thread->author->username, JSON_HEX_QUOT|JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS) }}' data-quote-body='{{ json_encode($thread->body, JSON_HEX_QUOT|JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS) }}'>

    <div class="forum-post-data">
        <div class="avatar">
        	{!! $thread->author->present()->avatar(40) !!}
        </div>
        <div class="info">
            <strong class="author">
            @if(Permission::has('users.show'))
                <a href="{{ $thread->author->present()->profileUrl }}">{{ $thread->author->username }}</a>
            @else
                {{ $thread->author->username }}
            @endif
            </strong>
            <ul class="inline-list grey">
                <li>
                    <time datetime="{{$thread->created_at->toISO8601String()}}" title="{{$thread->created_at->formatLocalized('%A %e %B %Y %T')}}">
                        {{ $thread->present()->created_ago }}
                    </time>
                </li>

                @if($thread->isManageableBy(Auth::user()))
                    <li><a href="{{ $thread->present()->editUrl }}">bewerk</a></li>
                    <li><a href="{{ $thread->present()->deleteUrl }}">verwijder</a></li>
                @endif

                @if(Auth::user())
                    <li><a href="#body" class="quote _quote_forum_post">quote</a></li>
                @endif
            </ul>
        </div>
    </div>

    <div class="body">
        {!! $thread->present()->bodyFormatted !!}
    </div>
</div>
