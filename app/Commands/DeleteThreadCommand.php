<?php namespace GSV\Commands;

use GSV\Commands\Command;

class DeleteThreadCommand extends Command {

    private $threadId;

	public function __construct($threadId)
	{
        $this->threadId = $threadId;
    }
}
