<?php namespace GSV\Events\Forum;

use GSV\Events\Event;
use Illuminate\Queue\SerializesModels;

class ReplyWasLiked extends Event {

    use SerializesModels;

    public $replyId;
    public $likeId;

    public function __construct($replyId, $likeId)
    {
        $this->replyId = $replyId;
        $this->likeId = $likeId;
    }
}