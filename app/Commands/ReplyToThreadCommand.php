<?php namespace GSV\Commands;

use GSV\Commands\Command;

class ReplyToThreadCommand extends Command {

    public $threadSlug;
    public $authorId;
    public $reply;

    public function __construct($threadSlug, $authorId, $reply)
	{
        $this->threadSlug = $threadSlug;
        $this->authorId = $authorId;
        $this->reply = $reply;
    }
}
