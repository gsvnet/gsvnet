<?php namespace GSV\Commands\Forum;

use GSV\Commands\Command;

class DeleteReplyCommand extends Command {

    public $replyId;

    public function __construct($replyId)
	{
        $this->replyId = $replyId;
    }

}
