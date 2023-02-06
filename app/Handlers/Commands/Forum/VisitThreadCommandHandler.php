<?php namespace App\Handlers\Commands\Forum;

use App\Commands\Forum\VisitThreadCommand;
use App\Helpers\Forum\Threads\ThreadVisitationUpdater;

class VisitThreadCommandHandler {

    private $updater;

    function __construct(ThreadVisitationUpdater $updater)
    {
        $this->updater = $updater;
    }

    public function handle(VisitThreadCommand $command)
    {
        $this->updater->update($command->threadId, $command->userId);
    }
}