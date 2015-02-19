<?php namespace GSV\Handlers\Events;

class ThreadEventHandler {
    public function subscribe($events)
    {
        $events->listen('GSV\Events\ThreadWasRepliedTo', 'GSV\Handlers\Events\UpdateThreadDetails@incrementReplies');
        $events->listen('GSV\Events\ThreadWasRepliedTo', 'GSV\Handlers\Events\UpdateThreadDetails@setNewLastReply');

        $events->listen('GSV\Events\ReplyWasDeleted', 'GSV\Handlers\Events\UpdateThreadDetails@decrementReplies');
        $events->listen('GSV\Events\ReplyWasDeleted', 'GSV\Handlers\Events\UpdateThreadDetails@resetLastReply');
    }
}