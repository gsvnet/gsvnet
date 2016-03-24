<?php namespace GSV\Commands\Forum;

use GSV\Commands\Command;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class VisitThreadCommand extends Command implements ShouldQueue {

	use InteractsWithQueue, SerializesModels;

    public $threadId;
    public $userId;

    public function __construct($threadId, $userId)
	{
        $this->threadId = $threadId;
        $this->userId = $userId;
    }
}
