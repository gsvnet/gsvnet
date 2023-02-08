<?php

namespace App\Helpers\Core;

use App\Helpers\Core\Exceptions\EntityNotFoundException;
use Illuminate\Database\Eloquent\Model;

abstract class EloquentRepository
{
    protected $model;

    public function __construct($model = null)
    {
        $this->model = $model;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function setModel($model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getAllPaginated($count)
    {
        return $this->model->paginate($count);
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function requireById($id)
    {
        $model = $this->getById($id);

        if (! $model) {
            throw new EntityNotFoundException;
        }

        return $model;
    }

    public function getNew($attributes = [])
    {
        return $this->model->newInstance($attributes);
    }

    public function save($data)
    {
        if ($data instanceof Model) {
            return $this->storeEloquentModel($data);
        } elseif (is_array($data)) {
            return $this->storeArray($data);
        }
    }

    public function delete($model)
    {
        return $model->delete();
    }

    public function deleteFromId($id)
    {
        $this->model->destroy($id);
    }

    protected function storeEloquentModel($model)
    {
        if ($model->getDirty()) {
            return $model->save();
        } else {
            return $model->touch();
        }
    }

    protected function storeArray($data)
    {
        $model = $this->getNew($data);

        return $this->storeEloquentModel($model);
    }
}
