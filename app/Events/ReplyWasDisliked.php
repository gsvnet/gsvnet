<?php namespace GSV\Events;

use Illuminate\Queue\SerializesModels;

class ReplyWasDisliked extends Event {

    use SerializesModels;

    public $replyId;
    public $userId;

    public function __construct($replyId, $userId)
    {
        $this->replyId = $replyId;
        $this->userId = $userId;
    }
}