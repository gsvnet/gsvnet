<?php namespace GSV\Handlers\Commands\Forum;

use GSV\Commands\Forum\StartThreadCommand;
use GSV\Events\Forum\ThreadWasStarted;
use GSVnet\Forum\Threads\ThreadRepository;

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
            'slug' => $command->slug,
            'reply_count' => 0,
            'most_recent_reply_id' => null
        ]);

        $this->threads->save($thread);
        $this->threads->setTags($thread, $command->tags);

        $thread->author->getAprilFools()->createThread();

        event(new ThreadWasStarted($thread));
	}
}
