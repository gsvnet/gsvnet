<?php namespace GSV\Commands\Forum;

use GSV\Commands\Command;

class DeleteThreadCommand extends Command {

    public $threadId;

	public function __construct($threadId)
	{
        $this->threadId = $threadId;
    }
}
