<div class="thread _post">

    <div class="forum-post-data">
        <div class="avatar">
        	{{ $thread->author->avatar(40) }}
        </div>
        <div class="info">
            <h6><a href="{{ $thread->author->profileUrl }}">{{ $thread->author->fullname }}</a></h6>
            <ul class="inline-list grey">
                <li>{{ $thread->created_ago }}</li>
                @if($thread->isManageableBy($currentUser))
                    <li><a href="{{ $thread->editUrl }}">Bewerk</a></li>
                    <li><a href="{{ $thread->deleteUrl }}">Verwijder</a></li>
                @endif

                @if(Auth::user())
                    <li><a href="#" class="quote _quote_forum_post">Quote</a></li>
                @endif
            </ul>
        </div>
    </div>

    <div class="markdown">
        {{ $thread->body }}
    </div>
</div>
