<?php namespace GSVnet\Files\Labels;

interface LabelsRepositoryInterface
{
    /**
    * Get all albums
    *
    * @return Collection
    */
    public function all();
}