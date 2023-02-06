<?php namespace App\Handlers\Events\Forum;

use App\Events\Forum\ReplyWasLiked;
use App\Events\Forum\ReplyWasDisliked;
use App\Helpers\Forum\Replies\ReplyRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateReplyDetails implements ShouldQueue {

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