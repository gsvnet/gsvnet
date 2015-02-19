<?php namespace GSV\Commands;

use GSV\Commands\Command;

class StartThreadCommand extends Command {

    public $authorId;
    public $subject;
    public $body;
    public $tags;
    public $public;

    public function __construct($authorId, $subject, $body, $tags, $public)
	{
        $this->subject = $subject;
        $this->body = $body;
        $this->public = $public;
        $this->tags = $tags;
        $this->authorId = $authorId;
    }

}
