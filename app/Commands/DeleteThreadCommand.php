<?php namespace GSV\Commands;

class DeleteThreadCommand extends Command {

    public $threadId;

	public function __construct($threadId)
	{
        $this->threadId = $threadId;
    }
}
