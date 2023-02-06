<?php namespace App\Commands\Forum;

use App\Commands\Command;

class DeleteThreadCommand extends Command {

    public $threadId;

	public function __construct($threadId)
	{
        $this->threadId = $threadId;
    }
}
