<?php namespace GSV\Handlers\Commands\Forum;

use GSV\Commands\Forum\ReplyToThreadCommand;
use GSV\Events\Forum\ThreadWasRepliedTo;
use GSVnet\Forum\Replies\ReplyRepository;
use GSVnet\Forum\Threads\ThreadRepository;
use Illuminate\Queue\InteractsWithQueue;

class ReplyToThreadCommandHandler {

    private $replies;
    private $threads;

    function __construct(ThreadRepository $threads, ReplyRepository $replies)
    {
        $this->replies = $replies;
        $this->threads = $threads;
    }

	public function handle(ReplyToThreadCommand $command)
	{
        $thread = $this->threads->requireBySlug($command->threadSlug);

        $reply = $this->replies->getNew([
            'thread_id' => $thread->id,
            'author_id' => $command->authorId,
            'body' => $command->reply
        ]);

        $this->replies->save($reply);

        event(new ThreadWasRepliedTo($thread, $reply));
	}

}
