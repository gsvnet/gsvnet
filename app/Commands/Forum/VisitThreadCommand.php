<?php

namespace App\Commands\Forum;

use App\Commands\Command;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class VisitThreadCommand extends Command implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    public $threadId;

    public $userId;

    public function __construct($threadId, $userId)
    {
        $this->threadId = $threadId;
        $this->userId = $userId;
    }
}
