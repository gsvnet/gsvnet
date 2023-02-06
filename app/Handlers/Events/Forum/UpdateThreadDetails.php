<?php namespace App\Handlers\Events\Forum;

use App\Events\Forum\ReplyWasDeleted;
use App\Events\Forum\ThreadWasDisliked;
use App\Events\Forum\ThreadWasLiked;
use App\Events\Forum\ThreadWasRepliedTo;

use App\Helpers\Forum\Threads\ThreadRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateThreadDetails implements ShouldQueue {

    private $threads;

    public function __construct(ThreadRepository $threads)
	{
        $this->threads = $threads;
    }

	public function incrementReplies(ThreadWasRepliedTo $event)
    {
        $this->threads->incrementReplies($event->thread->id);
    }

    public function setNewLastReply(ThreadWasRepliedTo $event)
    {
        $this->threads->setLastReply($event->thread->id, $event->reply->id);
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

    public function incrementLikes(ThreadWasLiked $event)
    {
        $this->threads->incrementLikeCount($event->threadId);
    }

    public function decrementLikes(ThreadWasDisliked $event)
    {
        $this->threads->decrementLikeCount($event->threadId);
    }
}
