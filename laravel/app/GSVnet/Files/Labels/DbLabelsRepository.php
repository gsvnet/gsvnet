<?php namespace GSVnet\Files\Labels;

use Model\Label;

class DbLabelsRepository implements LabelsRepositoryInterface
{
    /**
    * Get all albums
    *
    * @return Collection
    */
    public function all()
    {
        return Label::all();
    }
}