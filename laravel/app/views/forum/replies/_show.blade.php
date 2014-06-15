<div class="comment _post" id="reactie-{{ $reply->id }}" data-author-name='{{ json_encode($reply->author->username, JSON_HEX_QUOT|JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS) }}' data-quote-body='{{ json_encode($reply->body, JSON_HEX_QUOT|JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS) }}'>
    <div class="forum-post-data">
        <div class="avatar">
            {{ $reply->author->present()->avatarDeferred(40) }}
        </div>
        <div class="info">
            <strong class="author">
                @if(Permission::has('users.show'))
                    <a href="{{ $reply->author->present()->profileUrl }}">{{{ $reply->author->username }}}</a>
                @else
                    {{{ $reply->author->username }}}
                @endif
            </strong>
            <ul class="inline-list grey">
                <li><a href="#reactie-{{ $reply->id }}">
                <time datetime="{{{$reply->created_at->toISO8601String()}}}" title="{{{$reply->created_at->formatLocalized('%A %e %B %Y %T')}}}">{{ $reply->present()->created_ago }}</time></a></li>

                @if(Auth::check())
                    @if($reply->isManageableBy($currentUser))
                        <li><a href="{{ action('ForumRepliesController@getEditReply', [$reply->id]) }}">bewerk</a></li>
                        <li><a href="{{ action('ForumRepliesController@getDelete', [$reply->id]) }}">verwijder</a></li>
                    @endif
                    <li><a href="#body" class="quote _quote_forum_post">quote</a></li>
                @endif
            </ul>
        </div>
    </div>
    <div class="body">
        {{ $reply->present()->bodyFormatted }}
    </div>
</div>
