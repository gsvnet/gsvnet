<?php namespace GSV\Helpers\Files;

use GSV\Helpers\Core\Validator;

class FileUpdatorValidator extends Validator
{
    static $rules = [
        'name' => 'required'
    ];

}
