<?php

namespace App\Helpers\Files;

use App\Helpers\Core\Validator;

class FileCreatorValidator extends Validator
{
    public static $rules = [
        'name' => 'required',
        'file' => 'required',
    ];
}
