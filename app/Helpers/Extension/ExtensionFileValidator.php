<?php

namespace App\Helpers\Extension;


use App\Helpers\Core\Validator;

class ExtensionFileValidator extends Validator
{
    static $rules = [
        'file' => 'required'
    ];
}