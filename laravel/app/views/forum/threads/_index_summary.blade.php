<div class="media-row img-45 {{ $thread->visited }}">
    <div class="media-details">
        {{ $thread->author->present()->avatar(45) }}
        {{ $thread->present()->replyCounter }}
    </div>
    <div class="media-body">
        <h3><a href="{{ $thread->present()->lastPageUrl }}" title="Forum topic {{{ $thread->subject }}}">{{{ $thread->subject }}}</a></h3>

        <ul class="inline-list grey">
            <li>door <a href="{{ $thread->author->present()->profileUrl }}">{{{ $thread->author->username }}}</a></li>
            @if($thread->mostRecentReply)
                <li><a href="{{$thread->latestReplyUrl}}" title="Ga naar de laatste reactie van het onderwerp {{{$thread->title}}}">laatste reactie</a> {{{ $thread->mostRecentReply->updated_ago }}} door {{{ $thread->present()->mostRecentReplier }}}</li>
            @endif
        </ul>
    </div>
</div>
