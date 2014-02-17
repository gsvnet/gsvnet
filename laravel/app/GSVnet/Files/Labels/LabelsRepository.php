<?php namespace GSVnet\Files\Labels;

use Model\Label;

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