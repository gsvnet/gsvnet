<?php namespace GSV\Commands;

class StartThreadCommand extends Command {

    public $authorId;
    public $subject;
    public $body;
    public $tags;
    public $public;
    public $slug;

    public function __construct($authorId, $subject, $body, $tags, $public, $slug=null)
	{
        $this->subject = $subject;
        $this->body = $body;
        $this->public = $public;
        $this->tags = $tags;
        $this->authorId = $authorId;
        $this->slug = str_random(14);
    }

}
