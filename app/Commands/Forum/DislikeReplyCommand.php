<?php namespace GSV\Commands\Forum;

use GSV\Commands\Command;

class DislikeReplyCommand extends Command {

    public $replyId;
    public $userId;

    function __construct($replyId, $userId)
    {
        $this->replyId = $replyId;
        $this->userId = $userId;
    }
}