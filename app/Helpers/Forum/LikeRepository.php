<?php namespace GSV\Helpers\Forum;

use GSV\Helpers\Core\EloquentRepository;
use GSV\Helpers\Forum\Replies\Reply;
use GSV\Helpers\Forum\Threads\Thread;

class LikeRepository extends EloquentRepository {

    public function __construct(Like $model)
    {
        $this->model = $model;
    }

    public function dislikeReply($replyId, $userId)
    {
        $this->model->where('likable_id', $replyId)
            ->where('likable_type', Reply::class)
            ->where('user_id', $userId)
            ->delete();
    }

    public function dislikeThread($threadId, $userId)
    {
        $this->model->where('likable_id', $threadId)
            ->where('likable_type', Thread::class)
            ->where('user_id', $userId)
            ->delete();
    }

    public function countByReplyIdAndUserId($replyId, $userId)
    {
        return $this->model->where('likable_id', $replyId)
            ->where('likable_type', Reply::class)
            ->where('user_id', $userId)
            ->take(1)
            ->count();
    }

    public function countByThreadIdAndUserId($threadId, $userId)
    {
        return $this->model->where('likable_id', $threadId)
            ->where('likable_type', Thread::class)
            ->where('user_id', $userId)
            ->take(1)
            ->count();
    }
}