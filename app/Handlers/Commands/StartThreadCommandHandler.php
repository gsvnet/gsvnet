<?php namespace GSV\Handlers\Commands;

use GSV\Commands\StartThreadCommand;
use GSVnet\Forum\Threads\ThreadRepository;
use Illuminate\Queue\InteractsWithQueue;

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
            'slug' => $this->threads->generateUniqueSlugFrom($command->subject),
            'reply_count' => 0,
            'most_recent_reply_id' => null
        ]);

        $this->threads->save($thread);
        $this->threads->setTags($thread, $command->tags);
	}
}
