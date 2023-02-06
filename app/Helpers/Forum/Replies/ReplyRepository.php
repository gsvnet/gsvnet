<?php namespace GSV\Helpers\Forum\Replies;

use GSV\Helpers\Core\EloquentRepository;
use GSV\Helpers\Forum\Like;

class ReplyRepository extends EloquentRepository
{
    public function __construct(Reply $model)
    {
        $this->model = $model;
    }

    public function like(Reply $reply, Like $like)
    {
        $reply->likes()->save($like);
    }

    public function incrementLikeCount($replyId)
    {
        $this->model->where('id', $replyId)->increment('like_count');
    }

    public function decrementLikeCount($replyId)
    {
        $this->model->where('id', $replyId)->decrement('like_count');
    }
}