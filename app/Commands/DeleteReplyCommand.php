<?php namespace GSV\Commands;

use GSV\Commands\Command;

class DeleteReplyCommand extends Command {

    private $replyId;

    public function __construct($replyId)
	{
        $this->replyId = $replyId;
    }

}
