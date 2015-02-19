<?php namespace GSV\Commands;

use GSV\Commands\Command;

class EditReplyCommand extends Command {

    private $replyId;
    private $body;

    public function __construct($replyId, $body)
	{
        $this->replyId = $replyId;
        $this->body = $body;
    }

}
