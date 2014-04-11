<div class="media-row img-45">
    <div class="media-details">
        {{ $thread->author->avatar(45) }}
        {{ $thread->replyCounter }}
    </div>
    <div class="media-body">
        <h3><a href="{{ $thread->lastPageUrl }}" title="Forum topic {{{ $thread->subject }}}">{{{ $thread->subject }}}</a></h3>

        <ul class="inline-list grey">
            <li>door <a href="{{ $thread->author->profileUrl }}">{{{ $thread->author->username }}}</a></li>
            @if($thread->mostRecentReply)
                <li><a href="{{$thread->latestReplyUrl}}" title="Ga naar de laatste reactie van het onderwerp {{{$thread->title}}}">laatste reactie</a> {{{ $thread->updated_ago }}} door {{{ $thread->mostRecentReplier }}}</li>
            @endif
        </ul>
    </div>
</div>
