<?php namespace GSV\Handlers\Events\Forum;

use GSV\Events\Forum\ReplyWasDisliked;
use GSV\Events\Forum\ReplyWasLiked;
use GSVnet\Forum\Replies\ReplyRepository;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class UpdateReplyDetails implements ShouldBeQueued {

    private $replies;

    function __construct(ReplyRepository $replies)
    {
        $this->replies = $replies;
    }

    public function incrementLikes(ReplyWasLiked $event)
    {
        $this->replies->incrementLikeCount($event->replyId);
    }

    public function decrementLikes(ReplyWasDisliked $event)
    {
        $this->replies->decrementLikeCount($event->replyId);
    }
}