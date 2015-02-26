<?php namespace GSV\Handlers\Events;

class ThreadEventHandler {
    public function subscribe($events)
    {
        $events->listen('GSV\Events\Forum\ThreadWasRepliedTo', 'GSV\Handlers\Events\Forum\UpdateThreadDetails@incrementReplies');
        $events->listen('GSV\Events\Forum\ThreadWasRepliedTo', 'GSV\Handlers\Events\Forum\UpdateThreadDetails@setNewLastReply');

        $events->listen('GSV\Events\Forum\ReplyWasDeleted', 'GSV\Handlers\Events\Forum\UpdateThreadDetails@decrementReplies');
        $events->listen('GSV\Events\Forum\ReplyWasDeleted', 'GSV\Handlers\Events\Forum\UpdateThreadDetails@resetLastReply');

        $events->listen('GSV\Events\Forum\ReplyWasLiked', 'GSV\Handlers\Events\Forum\UpdateReplyDetails@incrementLikes');
        $events->listen('GSV\Events\Forum\ReplyWasDisliked', 'GSV\Handlers\Events\Forum\UpdateReplyDetails@decrementLikes');

        $events->listen('GSV\Events\Forum\ThreadWasLiked', 'GSV\Handlers\Events\Forum\UpdateThreadDetails@incrementLikes');
        $events->listen('GSV\Events\Forum\ThreadWasDisliked', 'GSV\Handlers\Events\Forum\UpdateThreadDetails@decrementLikes');
    }
}