<?php namespace GSV\Handlers\Commands\Forum;

use GSV\Commands\Forum\EditThreadCommand;
use GSVnet\Forum\Threads\ThreadRepository;

class EditThreadCommandHandler {

    private $threads;

    function __construct(ThreadRepository $threads)
    {
        $this->threads = $threads;
    }

    public function handle(EditThreadCommand $command)
    {
        $thread = $this->threads->getById($command->threadId);

        $thread->body = $command->body;
        $thread->public = $command->public;
        $thread->subject = $command->subject;

        $this->threads->save($thread);
        $this->threads->setTags($thread, $command->tags);
    }
}
