<?php namespace GSVnet\Files;

use GSVnet\Core\Validator;

class FileCreatorValidator extends Validator
{
    static $rules = [
        'name' => 'required',
        'file' => 'required'
    ];
}