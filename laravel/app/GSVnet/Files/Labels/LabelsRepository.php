<?php namespace GSVnet\Files\Labels;

use GSVnet\Files\Labels\Label;

class LabelsRepository
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