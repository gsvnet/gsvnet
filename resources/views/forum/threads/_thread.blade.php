<div class="thread _post">
    <div class="forum-post-data">
        <div class="avatar">
            <img src="{{ $thread->author->present()->getAvatar(40) }}" width="40" height="40">
        </div>
        <div class="like-box">
            @can('thread.like', $thread)
                <button class="like-box--button {!! $thread->present()->likeClass !!}" data-type="thread" data-id="{!! $thread->id !!}">
                    +<span class="like-box--count">{{ $thread->like_count }}</span>
                </button>
            @else
                +{{ $thread->like_count }}
            @endcan
        </div>
        <div class="info">
            <strong class="author">
                @can('users.show')
                    <a href="{{ $thread->author->present()->profileUrl }}">{{ $thread->author->username }}</a>
                @else
                    {{ $thread->author->username }}
                @endcan
            </strong>
            <ul class="inline-list grey">
                <li>
                    <time datetime="{{$thread->created_at->toISO8601String()}}" title="{{$thread->created_at->formatLocalized('%A %e %B %Y %T')}}">
                        {{ $thread->present()->created_ago }}
                    </time>
                </li>

                @can('thread.manage', $thread)
                    <li><a href="{{ $thread->present()->editUrl }}">bewerk</a></li>
                    <li><a href="{{ $thread->present()->deleteUrl }}">verwijder</a></li>
                @endcan

                @if(Auth::check())
                    <li><a href="#body" class="quote _quote_forum_post" data-type="thread" data-id="{{$thread->id}}">quote</a></li>
                @endif
            </ul>
        </div>
    </div>

    <div class="body">
        {!! $thread->present()->bodyFormatted !!}
    </div>
</div>
