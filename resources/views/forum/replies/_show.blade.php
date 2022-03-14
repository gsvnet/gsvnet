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
                    <li><a href="{{ action('ForumRepliesController@getEditReply', [$reply->id]) }}">bewerk</a></li>
                    <li><a href="{{ action('ForumRepliesController@getDelete', [$reply->id]) }}">verwijder</a></li>
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
    <div class="likers">
        @php
            $falselikers = [];
            for ($i = 0; $i < $reply->like_count; $i++) {
                $falselikers[] = $reply->falselikes[$i]->user;
            }

            // Check if user has liked the post. If so, put user at the top of the
            // falselikers list.
            $ids = array_map(function ($user) {
                return $user->id;
            }, $falselikers);
            if (Auth::check() && !$reply->likes->isEmpty()) {
                if (in_array(Auth::user()->id, $ids)) {
                    $idx = array_search(Auth::user()->id, $ids);
                    $falselikers[$idx] = $falselikers[0];
                }
                $falselikers[0] = Auth::user();
            }
        @endphp

        <div class="images">
            @for($i = 0; $i < min($reply->like_count, 3); $i++)
                <div>
                    <img src="{{ $falselikers[$i]->present()->avatar(40) }}" width="40" height="40" style="border-radius: 50%">
                </div>
            @endfor
        </div>

        <div class="text">
            @if($reply->like_count != 1)
                {!! $reply->like_count !!} GSV'ers vinden dit leuk.
            @else
                1 GSV'er vindt dit leuk.
            @endif
        </div>

        <div class="modal-bg">
            <div class="modal-content">
                <ul>
                    @for($i = 0; $i < $reply->like_count; $i++)
                        <li>
                            <img src="{{ $falselikers[$i]->present()->avatar(40) }}" width="40" height="40" style="border-radius: 50%">
                            <div class="text">{!! $falselikers[$i]->username !!}</div>
                        </li>
                    @endfor
                </ul>

                <button class="modal-button">Sluiten</button>
            </div>
        </div>
    </div>
</div>
