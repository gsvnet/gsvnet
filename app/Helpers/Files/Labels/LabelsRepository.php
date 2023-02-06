<?php namespace App\Helpers\Files\Labels;


class LabelsRepository
{
    /**
    * Get all labels
    */
    public function all()
    {
        return Label::all();
    }
}