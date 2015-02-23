<?php namespace GSVnet\Forum\Replies;

use GSVnet\Core\EloquentRepository;
use GSVnet\Forum\Like;

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
        $this->model->where('id', $replyId)->increment('likes');
    }

    public function decrementLikeCount($replyId)
    {
        $this->model->where('id', $replyId)->decrement('likes');
    }
}