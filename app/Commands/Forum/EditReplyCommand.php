<?php namespace GSV\Commands\Forum;

use GSV\Commands\Command;

class EditReplyCommand extends Command {

    public $replyId;
    public $reply;

    public function __construct($replyId, $reply)
	{
        $this->replyId = $replyId;
        $this->reply = $reply;
    }

}
