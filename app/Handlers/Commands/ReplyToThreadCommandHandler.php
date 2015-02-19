<?php namespace GSV\Handlers\Commands;

use GSV\Commands\ReplyToThreadCommand;
use GSV\Events\ThreadWasRepliedTo;
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
        $threadId = $this->threads->getIdBySlug($command->threadSlug);

        $reply = $this->replies->getNew([
            'thread_id' => $threadId,
            'author_id' => $command->authorId,
            'body' => $command->reply
        ]);

        $this->replies->save($reply);

        event(new ThreadWasRepliedTo($threadId, $reply->id));
	}

}
