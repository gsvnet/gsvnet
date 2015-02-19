<?php namespace GSV\Commands;

class DeleteThreadCommand extends Command {

    private $threadId;

	public function __construct($threadId)
	{
        $this->threadId = $threadId;
    }
}
