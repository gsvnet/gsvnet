<?php namespace GSV\Events\Forum;

use Illuminate\Queue\SerializesModels;

class ThreadWasLiked extends Event {

    use SerializesModels;

    public $threadId;
    public $likeId;

    public function __construct($threadId, $likeId)
    {
        $this->threadId = $threadId;
        $this->likeId = $likeId;
    }
}