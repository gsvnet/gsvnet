<?php namespace GSV\Commands;

use GSVnet\Forum\Threads\ThreadVisitationUpdater;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class VisitThreadCommand extends Command implements ShouldBeQueued {

	use InteractsWithQueue, SerializesModels;

    public $threadId;
    public $userId;

    public function __construct($threadId, $userId)
	{
        $this->threadId = $threadId;
        $this->userId = $userId;
    }
}
