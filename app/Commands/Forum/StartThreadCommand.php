<?php namespace GSV\Commands\Forum;

use GSV\Commands\Command;

class StartThreadCommand extends Command {

    public $authorId;
    public $subject;
    public $body;
    public $tags;
    public $public;
    public $slug;
    public $atv;

    public function __construct($authorId, $subject, $body, $tags, $public, $slug, $atv)
	{
        $this->subject = $subject;
        $this->body = $body;
        $this->public = $public;
        $this->tags = $tags;
        $this->authorId = $authorId;
        $this->slug = $slug;
        $this->atv = $atv;
    }

}
