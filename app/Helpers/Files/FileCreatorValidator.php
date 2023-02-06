<?php namespace GSV\Helpers\Files;

use GSV\Helpers\Core\Validator;

class FileCreatorValidator extends Validator
{
    static $rules = [
        'name' => 'required',
        'file' => 'required'
    ];
}