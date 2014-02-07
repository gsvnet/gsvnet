<?php namespace GSVnet\Validators;

class FileCreatorValidator extends Validator
{
    static $rules = [
        'name' => 'required',
        'file' => 'required'
    ];
}