<?php namespace GSV\Helpers\Files\Labels;


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