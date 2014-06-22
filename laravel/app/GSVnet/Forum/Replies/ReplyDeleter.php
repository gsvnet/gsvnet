<?php namespace GSVnet\Forum\Replies;

use GSVnet\Comments\CommentRepository;

/**
* This class can call the following methods on the observer object:
*
* replyDeleted($thread)
*/
class ReplyDeleter
{
    protected $comments;

    public function __construct(CommentRepository $comments)
    {
        $this->comments = $comments;
    }

    public function delete(ReplyDeleterListener $observer, $reply)
    {
        $thread = $reply->thread;
        $reply->delete();

        $thread->updateReplyCount();
        
        // Update last reply.
        $last = $thread->replies()->orderBy('created_at', 'DESC')->first();
        $thread->setMostRecentReply($last);

        return $observer->replyDeleted($thread);
    }
}
