<?php namespace GSV\Handlers\Commands\Forum;

use GSV\Commands\Forum\StartThreadCommand;
use GSV\Events\Forum\ThreadWasStarted;
use GSV\Helpers\Forum\Threads\ThreadRepository;

class StartThreadCommandHandler {

    private $threads;

    function __construct(ThreadRepository $threads)
    {
        $this->threads = $threads;
    }

    public function handle(StartThreadCommand $command)
	{
		$thread = $this->threads->getNew([
            'subject' => $command->subject,
            'body' => $command->body,
            'author_id' => $command->authorId,
            'public' => $command->public,
            'private' => $command->private,
            'slug' => $command->slug,
            'reply_count' => 0,
            'most_recent_reply_id' => null
        ]);

        $this->threads->save($thread);
        $this->threads->setTags($thread, $command->tags);

        event(new ThreadWasStarted($thread));
	}
}
