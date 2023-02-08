<?php

namespace App\Events\Forum;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class ReplyWasLiked extends Event
{
    use SerializesModels;

    public $replyId;

    public $likeId;

    public function __construct($replyId, $likeId)
    {
        $this->replyId = $replyId;
        $this->likeId = $likeId;
    }
}
