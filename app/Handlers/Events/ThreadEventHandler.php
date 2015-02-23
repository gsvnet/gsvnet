<?php namespace GSV\Handlers\Events;

class ThreadEventHandler {
    public function subscribe($events)
    {
        $events->listen('GSV\Events\ThreadWasRepliedTo', 'GSV\Handlers\Events\UpdateThreadDetails@incrementReplies');
        $events->listen('GSV\Events\ThreadWasRepliedTo', 'GSV\Handlers\Events\UpdateThreadDetails@setNewLastReply');

        $events->listen('GSV\Events\ReplyWasDeleted', 'GSV\Handlers\Events\UpdateThreadDetails@decrementReplies');
        $events->listen('GSV\Events\ReplyWasDeleted', 'GSV\Handlers\Events\UpdateThreadDetails@resetLastReply');

        $events->listen('GSV\Events\ReplyWasLiked', 'GSV\Handlers\Events\UpdateReplyDetails@incrementLikes');
        $events->listen('GSV\Events\ReplyWasDisliked', 'GSV\Handlers\Events\UpdateReplyDetails@decrementLikes');

        $events->listen('GSV\Events\ThreadWasLiked', 'GSV\Handlers\Events\UpdateThreadDetails@incrementLikes');
        $events->listen('GSV\Events\ThreadWasDisliked', 'GSV\Handlers\Events\UpdateThreadDetails@decrementLikes');
    }
}