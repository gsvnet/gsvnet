<?php

namespace App\Events\Forum;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class ThreadWasLiked extends Event
{
    use SerializesModels;

    public $threadId;

    public $likeId;

    public function __construct($threadId, $likeId)
    {
        $this->threadId = $threadId;
        $this->likeId = $likeId;
    }
}
