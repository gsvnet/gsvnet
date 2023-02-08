<?php

namespace App\Helpers\Forum\Replies;

class ReplySearch
{
    protected $model;

    public function __construct(Reply $model)
    {
        $this->model = $model;
    }

    public function searchReplys($query)
    {
        $replys = $this->model->where(function ($q) use ($query) {
            $q->Where('body', 'like', '%'.$query.'%');
        })->get();

        $result = [];

        foreach ($replys as $reply) {
            $result[] = $reply->thread_id;
        }

        return $result;
    }
}
