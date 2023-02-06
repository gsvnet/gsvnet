<?php namespace App\Handlers\Commands\Forum;

use App\Commands\Forum\DeleteThreadCommand;
use App\Helpers\Forum\Threads\ThreadRepository;

class DeleteThreadCommandHandler {

    private $threads;

    function __construct(ThreadRepository $threads)
    {
        $this->threads = $threads;
    }

    public function handle(DeleteThreadCommand $command)
	{
		$thread = $this->threads->getById($command->threadId);

        $this->threads->delete($thread);
	}

}
