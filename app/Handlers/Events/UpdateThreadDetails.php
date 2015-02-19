<?php namespace GSV\Handlers\Events;

use GSV\Events\ReplyWasDeleted;
use GSV\Events\ThreadWasRepliedTo;

use GSVnet\Forum\Threads\ThreadRepository;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class UpdateThreadDetails implements ShouldBeQueued {

    private $threads;

    public function __construct(ThreadRepository $threads)
	{
        $this->threads = $threads;
    }

	public function incrementReplies(ThreadWasRepliedTo $event)
    {
        $this->threads->incrementReplies($event->threadId);
    }

    public function setNewLastReply(ThreadWasRepliedTo $event)
    {
        $this->threads->setLastReply($event->threadId, $event->replyId);
	}

    public function decrementReplies(ReplyWasDeleted $event)
    {
        $this->threads->decrementReplies($event->threadId);
    }

    public function resetLastReply(ReplyWasDeleted $event)
    {
        $thread = $this->threads->requireById($event->threadId);

        if($thread->most_recent_reply_id == $event->replyId)
            $this->threads->resetLatestReplyFor($thread);
    }
}
