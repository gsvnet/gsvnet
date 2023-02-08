<?php

namespace App\Helpers\Files;

use App\Helpers\Core\Validator;

class FileUpdatorValidator extends Validator
{
    public static $rules = [
        'name' => 'required',
    ];
}
