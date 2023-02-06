<?php namespace App\Commands\Forum;

use App\Commands\Command;

class StartThreadCommand extends Command {

    public $authorId;
    public $subject;
    public $body;
    public $tags;
    public $public;
    public $private;
    public $slug;

    public function __construct($authorId, $subject, $body, $tags, $public, $private, $slug)
	{
        $this->subject = $subject;
        $this->body = $body;
        $this->public = $public;
        $this->private = $private;
        $this->tags = $tags;
        $this->authorId = $authorId;
        $this->slug = $slug;
    }

}
