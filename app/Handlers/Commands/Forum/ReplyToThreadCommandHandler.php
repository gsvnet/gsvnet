<?php namespace App\Handlers\Commands\Forum;

use App\Commands\Forum\ReplyToThreadCommand;
use App\Events\Forum\ThreadWasRepliedTo;
use App\Helpers\Forum\Replies\ReplyRepository;
use App\Helpers\Forum\Threads\ThreadRepository;

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
