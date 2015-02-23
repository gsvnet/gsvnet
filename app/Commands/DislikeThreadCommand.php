<?php namespace GSV\Commands;

class DislikeThreadCommand extends Command {

    public $threadId;
    public $userId;

    function __construct($threadId, $userId)
    {
        $this->threadId = $threadId;
        $this->userId = $userId;
    }
}