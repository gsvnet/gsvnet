<div class="comment _post" id="reactie-{{ $reply->id }}">
    <div class="forum-post-data">
        @if($reply->author)
        <div class="avatar">
            {!! $reply->author->present()->avatarDeferred(40) !!}
        </div>
        @endif
        <div class="like-box">
            @if(Auth::check() && $reply->author && $reply->author_id != Auth::user()->id)
                <button class="like-box--button {!! $reply->present()->likeClass !!}" data-type="reply" data-id="{!! $reply->id !!}">
                    +<span class="like-box--count">{{ $reply->like_count }}</span>
                </button>
            @else
                +{{ $reply->like_count }}
            @endif
        </div>
        <div class="info">
            @if($reply->author)
            <strong class="author">
                @if(Permission::has('users.show'))
                    <a href="{{ $reply->author->present()->profileUrl }}">{{{ $reply->author->username }}}</a>
                @else
                    {{ $reply->author->username }}
                @endif
            </strong>
            @endif
            <ul class="inline-list grey">
                <li>
                    <a href="#reactie-{{ $reply->id }}">
                       <time datetime="{{{$reply->created_at->toISO8601String()}}}" title="{{{$reply->created_at->formatLocalized('%A %e %B %Y %T')}}}">{{ $reply->present()->created_ago }}</time>
                    </a>
                </li>

                @if(Auth::check())
                    @if($reply->isManageableBy(Auth::user()))
                        <li><a href="{{ action('ForumRepliesController@getEditReply', [$reply->id]) }}">bewerk</a></li>
                        <li><a href="{{ action('ForumRepliesController@getDelete', [$reply->id]) }}">verwijder</a></li>
                    @endif
                    <li><a href="#body" class="quote _quote_forum_post" data-type="reply" data-id="{{$reply->id}}">quote</a></li>
                @endif
            </ul>
        </div>
    </div>
    <div class="body">
        {!! $reply->present()->bodyFormatted !!}
    </div>
</div>
