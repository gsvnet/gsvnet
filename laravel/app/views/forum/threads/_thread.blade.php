<div class="thread _post" data-author-name='{{ json_encode($thread->author->username, JSON_HEX_QUOT|JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS) }}' data-quote-body='{{ json_encode($thread->body, JSON_HEX_QUOT|JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS) }}'>

    <div class="forum-post-data">
        <div class="avatar">
        	{{ $thread->author->present()->avatar(40) }}
        </div>
        <div class="info">
            <strong class="author"><a href="{{ $thread->author->present()->profileUrl }}">{{{ $thread->author->username }}}</a></strong>
            <ul class="inline-list grey">
                <li>{{ $thread->present()->created_ago }}</li>
                @if($thread->isManageableBy($currentUser))
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
        {{ $thread->present()->bodyFormatted }}
    </div>
</div>
