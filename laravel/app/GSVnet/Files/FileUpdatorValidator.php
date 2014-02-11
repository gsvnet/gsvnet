<?php namespace GSVnet\Files;

use GSVnet\Core\Validator;

class FileUpdatorValidator extends Validator
{
    static $rules = [
        'name' => 'required'
    ];

}
