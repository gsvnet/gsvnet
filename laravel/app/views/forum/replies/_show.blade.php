<div class="comment _post" id="reactie-{{ $reply->id }}">

    <div class="forum-post-data">
        <div class="avatar">
            {{ $reply->author->present()->avatar(40) }}
        </div>
        <div class="info">
            <h6><a href="{{ $reply->author->present()->profileUrl }}">{{{ $reply->author->username }}}</a></h6>
            <ul class="inline-list grey">
                <li><a href="#reactie-{{ $reply->id }}">{{ $reply->present()->created_ago }}</a></li>

                @if(Auth::check())
                    @if($reply->isManageableBy($currentUser))
                        <li><a href="{{ action('ForumRepliesController@getEditReply', [$reply->id]) }}">bewerk</a></li>
                        <li><a href="{{ action('ForumRepliesController@getDelete', [$reply->id]) }}">verwijder</a></li>
                    @endif
                    <li><a href="#" class="quote _quote_forum_post">quote</a></li>
                @endif
            </ul>
        </div>
    </div>
    <div class="markdown">
        {{ $reply->present()->bodyFormatted }}
    </div>
</div>
