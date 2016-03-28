<?php namespace GSV\Handlers\Events;

use Illuminate\Contracts\Events\Dispatcher;

class ThreadEventHandler {
    public function subscribe(Dispatcher $events)
    {
        $events->listen(\GSV\Events\Forum\ThreadWasRepliedTo::class, 'GSV\Handlers\Events\Forum\UpdateThreadDetails@incrementReplies');
        $events->listen(\GSV\Events\Forum\ThreadWasRepliedTo::class, 'GSV\Handlers\Events\Forum\UpdateThreadDetails@setNewLastReply');

        $events->listen(\GSV\Events\Forum\ReplyWasDeleted::class, 'GSV\Handlers\Events\Forum\UpdateThreadDetails@decrementReplies');
        $events->listen(\GSV\Events\Forum\ReplyWasDeleted::class, 'GSV\Handlers\Events\Forum\UpdateThreadDetails@resetLastReply');

        $events->listen(\GSV\Events\Forum\ReplyWasLiked::class, 'GSV\Handlers\Events\Forum\UpdateReplyDetails@incrementLikes');
        $events->listen(\GSV\Events\Forum\ReplyWasDisliked::class, 'GSV\Handlers\Events\Forum\UpdateReplyDetails@decrementLikes');

        $events->listen(\GSV\Events\Forum\ThreadWasLiked::class, 'GSV\Handlers\Events\Forum\UpdateThreadDetails@incrementLikes');
        $events->listen(\GSV\Events\Forum\ThreadWasDisliked::class, 'GSV\Handlers\Events\Forum\UpdateThreadDetails@decrementLikes');
    }
}