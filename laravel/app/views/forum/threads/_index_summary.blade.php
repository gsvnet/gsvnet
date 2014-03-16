<div class="event-row">
    <div class="event-details">
        {{ $thread->author->avatar(100) }}
    </div>
    <div class="event-body">
        <h3><a href="{{ $thread->url }}">{{ $thread->subject }}</a></h3>

        <ul class="inline-list grey">
            <li>door <a href="{{ $thread->author->profileUrl }}">{{ $thread->author->fullname }}</a></li>
            @if($thread->mostRecentReply)
                <li>laatste reactie {{ $thread->updated_ago }} by {{ $thread->mostRecentReplier }}</li>
            @endif
        </ul>
    </div>

</div>