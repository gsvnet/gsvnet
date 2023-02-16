<div class="comment _post" id="reactie-{{ $reply->id }}">
    <div class="forum-post-data">
        @if($reply->author)
        <div class="avatar">
            <img src="{{ $reply->author->present()->avatar(40) }}" width="40" height="40" style="border-radius: 50%">
        </div>
        @endif
        <div class="like-box" style="border-radius: 15%">
            @can('reply.like', $reply)
                <button style="border-radius: 15%" class="like-box--button {!! $reply->present()->likeClass !!}" data-type="reply" data-id="{!! $reply->id !!}">
                    +<span style="border-radius: 15%" class="like-box--count">{{ $reply->like_count }}</span>
                </button>
            @else
                +{{ $reply->like_count }}
            @endcan
        </div>
        <div class="info">
            @if($reply->author)
            <strong class="author">
                @can('users.show')
                    <a href="{{ $reply->author->present()->profileUrl }}">{{{ $reply->author->username }}}</a>
                @else
                    {{ $reply->author->username }}
                @endcan
            </strong>
            @endif
            <ul class="inline-list grey">
                <li>
                    <a href="#reactie-{{ $reply->id }}">
                       <time datetime="{{{$reply->created_at->toISO8601String()}}}" title="{{{$reply->created_at->formatLocalized('%A %e %B %Y %T')}}}">{{ $reply->present()->created_ago }}</time>
                    </a>
                </li>

                @can('reply.manage', $reply)
                    <li><a href="{{ action([\App\Http\Controllers\ForumRepliesController::class, 'getEditReply'], [$reply->id]) }}">bewerk</a></li>
                    <li><a href="{{ action([\App\Http\Controllers\ForumRepliesController::class, 'getDelete'], [$reply->id]) }}">verwijder</a></li>
                @endcan

                @if(Auth::check())
                    <li><a href="#body" class="quote _quote_forum_post" data-type="reply" data-id="{{$reply->id}}">quote</a></li>
                @endif
            </ul>
        </div>
    </div>
    <div class="body">
        {!! $reply->present()->bodyFormatted !!}
    </div>
</div>
