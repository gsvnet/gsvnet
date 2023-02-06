<?php namespace App\Handlers\Commands\Forum;

use App\Commands\Forum\EditThreadCommand;
use App\Helpers\Forum\Threads\ThreadRepository;

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
        $thread->private = $command->private;
        $thread->subject = $command->subject;

        // Determine whether nothing but the public flag has been changed
        // If so, don't update timestamps, so the topic doesn't jump to the top
        if(!array_diff_key($thread->getDirty(), ["public" => null])
            || !array_diff_key($thread->getDirty(), ["private" => null])) {
            $thread->timestamps = false;
        }

        $this->threads->save($thread);
        $this->threads->setTags($thread, $command->tags);
    }
}
