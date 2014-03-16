<div class="event-row">
    <div class="event-details">
        {{ $thread->author->avatar(100) }}
    </div>
    <div class="event-body">
        <h3><a href="{{ $thread->url }}">{{ $thread->subject }}</a></h3>

        <ul class="inline-list grey">
            <li>door <a href="{{ $thread->author->profileUrl }}">{{ $thread->author->username }}</a></li>
            @if($thread->mostRecentReply)
                <li><a href="{{$thread->latestReplyUrl}}" title="Ga naar de laatste reactie van het onderwerp {{{$thread->title}}}">laatste reactie</a> {{ $thread->updated_ago }} door {{ $thread->mostRecentReplier }}</li>
            @endif
        </ul>
    </div>

</div>
