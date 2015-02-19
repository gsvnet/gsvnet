<?php namespace GSV\Commands;

class DeleteReplyCommand extends Command {

    public $replyId;

    public function __construct($replyId)
	{
        $this->replyId = $replyId;
    }

}
