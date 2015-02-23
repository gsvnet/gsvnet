<?php namespace GSV\Commands;

class LikeReplyCommand extends Command {

    public $replyId;
    public $userId;

    function __construct($replyId, $userId)
    {
        $this->replyId = $replyId;
        $this->userId = $userId;
    }
}