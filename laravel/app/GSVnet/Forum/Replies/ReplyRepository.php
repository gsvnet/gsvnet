<?php namespace GSVnet\Forum\Replies;

use Illuminate\Support\Collection;

class ReplyRepository extends \GSVnet\Core\EloquentRepository
{
    public function __construct(Reply $model)
    {
        $this->model = $model;
    }
}