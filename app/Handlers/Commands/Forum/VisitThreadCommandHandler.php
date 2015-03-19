<?php namespace GSV\Handlers\Commands\Forum;

use GSV\Commands\Forum\VisitThreadCommand;
use GSVnet\Forum\Threads\ThreadVisitationUpdater;

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