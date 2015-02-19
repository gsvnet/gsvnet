<?php namespace GSV\Commands;

class EditReplyCommand extends Command {

    public $replyId;
    public $reply;

    public function __construct($replyId, $reply)
	{
        $this->replyId = $replyId;
        $this->reply = $reply;
    }

}
