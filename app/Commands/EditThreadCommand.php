<?php namespace GSV\Commands;

use GSV\Commands\Command;

class EditThreadCommand extends Command {

    private $threadId;
    private $subject;
    private $body;
    private $public;
    private $tags;

    public function __construct($threadId, $subject, $body, $public, $tags)
	{
        $this->threadId = $threadId;
        $this->subject = $subject;
        $this->body = $body;
        $this->public = $public;
        $this->tags = $tags;
    }

}
