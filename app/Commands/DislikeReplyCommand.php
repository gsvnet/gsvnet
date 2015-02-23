<?php namespace GSV\Commands;

class DislikeReplyCommand extends Command {

    public $replyId;
    public $userId;

    function __construct($replyId, $userId)
    {
        $this->replyId = $replyId;
        $this->userId = $userId;
    }
}