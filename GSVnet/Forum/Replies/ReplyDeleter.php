<?php namespace GSVnet\Forum\Replies;

class ReplyDeleter
{
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
