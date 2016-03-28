<?php namespace GSV\Events\Forum;

use GSV\Events\Event;
use Illuminate\Queue\SerializesModels;

class ReplyWasDeleted extends Event {

    use SerializesModels;

    public $threadId;
    public $replyId;

    public function __construct($threadId, $replyId)
    {
        $this->threadId = $threadId;
        $this->replyId = $replyId;
    }
}