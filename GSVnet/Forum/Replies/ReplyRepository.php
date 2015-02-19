<?php namespace GSVnet\Forum\Replies;

use GSVnet\Core\EloquentRepository;

class ReplyRepository extends EloquentRepository
{
    public function __construct(Reply $model)
    {
        $this->model = $model;
    }
}