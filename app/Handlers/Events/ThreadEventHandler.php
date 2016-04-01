<?php namespace GSV\Handlers\Events;

use GSV\Events\Forum\ReplyWasDeleted;
use GSV\Events\Forum\ReplyWasDisliked;
use GSV\Events\Forum\ReplyWasLiked;
use GSV\Events\Forum\ThreadWasDisliked;
use GSV\Events\Forum\ThreadWasLiked;
use GSV\Events\Forum\ThreadWasRepliedTo;
use Illuminate\Contracts\Events\Dispatcher;

class ThreadEventHandler {
    public function subscribe(Dispatcher $events)
    {
        $events->listen(ThreadWasRepliedTo::class, 'GSV\Handlers\Events\Forum\UpdateThreadDetails@incrementReplies');
        $events->listen(ThreadWasRepliedTo::class, 'GSV\Handlers\Events\Forum\UpdateThreadDetails@setNewLastReply');

        $events->listen(ReplyWasDeleted::class, 'GSV\Handlers\Events\Forum\UpdateThreadDetails@decrementReplies');
        $events->listen(ReplyWasDeleted::class, 'GSV\Handlers\Events\Forum\UpdateThreadDetails@resetLastReply');

        $events->listen(ReplyWasLiked::class, 'GSV\Handlers\Events\Forum\UpdateReplyDetails@incrementLikes');
        $events->listen(ReplyWasDisliked::class, 'GSV\Handlers\Events\Forum\UpdateReplyDetails@decrementLikes');

        $events->listen(ThreadWasLiked::class, 'GSV\Handlers\Events\Forum\UpdateThreadDetails@incrementLikes');
        $events->listen(ThreadWasDisliked::class, 'GSV\Handlers\Events\Forum\UpdateThreadDetails@decrementLikes');
    }
}