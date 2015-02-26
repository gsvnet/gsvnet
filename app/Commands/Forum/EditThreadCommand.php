<?php namespace GSV\Commands\Forum;

use GSV\Commands\Command;

class EditThreadCommand extends Command {

    public $threadId;
    public $subject;
    public $body;
    public $public;
    public $tags;

    public function __construct($threadId, $subject, $body, $public, $tags)
	{
        $this->threadId = $threadId;
        $this->subject = $subject;
        $this->body = $body;
        $this->public = $public;
        $this->tags = $tags;
    }

}
