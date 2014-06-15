<div class="media-row img-45 {{ $thread->present()->visited }}">
    <div class="media-details">
        {{ $thread->author->present()->avatarDeferred(45) }}
        {{ $thread->present()->replyCounter }}
    </div>
    <div class="media-body">
        <h3><a href="{{ $thread->present()->lastPageUrl }}" title="Forum topic {{{ $thread->subject }}}">{{{ $thread->subject }}}</a></h3>

        <ul class="inline-list grey">
            <li>door 
            @if(Permission::has('users.show'))
                <a href="{{ $thread->author->present()->profileUrl }}">{{{ $thread->author->username }}}</a>
            @else
                {{{ $thread->author->username }}}
            @endif
            </li>

            @if($thread->mostRecentReply)
                <li><a href="{{$thread->present()->latestReplyUrl}}" title="Ga naar de laatste reactie van het onderwerp {{{$thread->title}}}"><time datetime="{{{$thread->mostRecentReply->created_at->toISO8601String()}}}" title="{{{$thread->mostRecentReply->created_at->formatLocalized('%A %e %B %Y %T')}}}">{{ $thread->mostRecentReply->present()->updated_ago }}</time></a> door {{{ $thread->present()->mostRecentReplier }}}</li>
            @endif
        </ul>
    </div>
</div>
