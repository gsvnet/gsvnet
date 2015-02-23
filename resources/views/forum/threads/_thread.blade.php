<div class="thread _post">
    <div class="forum-post-data">
        <div class="avatar">
        	{!! $thread->author->present()->avatar(40) !!}
        </div>
        <div class="like-box">
            @if(Auth::check())
                <button class="like-box--button {!! $thread->present()->likeClass !!}" data-type="thread" data-id="{!! $thread->id !!}">
                    +<span class="like-box--count">{{ $thread->likes }}</span>
                </button>
            @else
                {{ $reply->likes }}
            @endif
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
                    <li><a href="#body" class="quote _quote_forum_post" data-type="thread" data-id="{{$thread->id}}">quote</a></li>
                @endif
            </ul>
        </div>
    </div>

    <div class="body">
        {!! $thread->present()->bodyFormatted !!}
    </div>
</div>
