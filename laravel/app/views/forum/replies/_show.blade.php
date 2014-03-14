<div class="comment _post" id="reactie-{{ $reply->id }}">

    <div class="forum-post-data">
        <div class="avatar">
            {{ $reply->author->avatar(40) }}
        </div>
        <div class="info">
            <h6><a href="{{ $reply->author->profileUrl }}">{{ $reply->author->fullname }}</a></h6>
            <ul class="inline-list grey">
                <li><a href="{{ $reply->url }}">{{ $reply->created_ago }}</a></li>

                @if(Auth::check())
                    @if($reply->isManageableBy($currentUser))
                        <li><a href="{{ action('ForumRepliesController@getEditReply', [$reply->id]) }}">Bewerk</a></li>
                        <li><a href="{{ action('ForumRepliesController@getDelete', [$reply->id]) }}">Verwijder</a></li>
                    @endif
                    <li><a href="#" class="quote _quote_forum_post">Quote</a></li>
                @endif
            </ul>
        </div>
    </div>
    <div class="markdown">
        {{ $reply->body }}
    </div>
</div>
