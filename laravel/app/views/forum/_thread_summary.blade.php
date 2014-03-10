<div class="thread-summary">
    <div class="avatar">
    	{{ $thread->author->avatar(80) }}
    </div>
    <div class="info">
        <h3><a href="{{ $thread->url }}">{{ $thread->subject }}</a></h3>
        <ul class="meta">
            <li>posted by <a href="{{ $thread->author->profileUrl }}">{{ $thread->author->name }}</a></li>
            <li>updated {{ $thread->updated_ago }}</li>
        </ul>
    </div>
    <div class="comment-count">{{ $thread->reply_count }}</div>
</div>
