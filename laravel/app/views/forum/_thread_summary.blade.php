<div class="thread-summary">
    <div class="avatar">
    	{{ $thread->author->present()->avatar(40) }}
    </div>
    <div class="info">
        <h3><a href="{{ $thread->url }}">{{ $thread->subject }}</a></h3>
        <ul class="meta">
            <li>posted by <a href="{{ $thread->author->profileUrl }}">{{{ $thread->author->username }}}</a></li>
            <li>updated {{ $thread->updated_ago }}</li>
        </ul>
    </div>
    <div class="comment-count">{{ $thread->reply_count }}</div>
</div>
