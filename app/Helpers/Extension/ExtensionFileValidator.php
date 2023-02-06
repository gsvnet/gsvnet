<?php

namespace GSV\Helpers\Extension;


use GSV\Helpers\Core\Validator;

class ExtensionFileValidator extends Validator
{
    static $rules = [
        'file' => 'required'
    ];
}