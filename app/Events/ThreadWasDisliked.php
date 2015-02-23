<?php namespace GSV\Events;

use Illuminate\Queue\SerializesModels;

class ThreadWasDisliked extends Event {

    use SerializesModels;

    public $threadId;
    public $userId;

    public function __construct($threadId, $userId)
    {
        $this->threadId = $threadId;
        $this->userId = $userId;
    }
}