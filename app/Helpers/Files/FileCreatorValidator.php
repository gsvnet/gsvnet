<?php namespace App\Helpers\Files;

use App\Helpers\Core\Validator;

class FileCreatorValidator extends Validator
{
    static $rules = [
        'name' => 'required',
        'file' => 'required'
    ];
}