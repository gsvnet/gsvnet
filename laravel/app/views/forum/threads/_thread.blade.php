<div class="thread _post">

    <div class="forum-post-data">
        <div class="avatar">
        	{{ $thread->author->present()->avatar(40) }}
        </div>
        <div class="info">
            <h6><a href="{{ $thread->author->profileUrl }}">{{{ $thread->author->username }}}</a></h6>
            <ul class="inline-list grey">
                <li>{{ $thread->present()->created_ago }}</li>
                @if($thread->isManageableBy($currentUser))
                    <li><a href="{{ $thread->editUrl }}">bewerk</a></li>
                    <li><a href="{{ $thread->deleteUrl }}">verwijder</a></li>
                @endif

                @if(Auth::user())
                    <li><a href="#" class="quote _quote_forum_post">quote</a></li>
                @endif
            </ul>
        </div>
    </div>

    <div class="markdown">
        {{ $thread->present()->bodyFormatted }}
    </div>
</div>
