<?php namespace GSVnet\Core;

use Illuminate\Database\Eloquent\Model;

class BaseRepository {

    protected $model;

    function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function save(Model $model)
    {
        $model->save();
    }
}