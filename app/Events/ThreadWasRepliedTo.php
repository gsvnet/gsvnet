<?php namespace GSV\Events;

use Illuminate\Queue\SerializesModels;

class ThreadWasRepliedTo extends Event {

	use SerializesModels;

    public $threadId;
    public $replyId;

    public function __construct($threadId, $replyId)
	{
        $this->threadId = $threadId;
        $this->replyId = $replyId;
    }
}
