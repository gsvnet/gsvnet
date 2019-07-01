<?php

namespace GSVnet\Extension;


use GSVnet\Core\Validator;

class ExtensionFileValidator extends Validator
{
    static $rules = [
        'file' => 'required'
    ];
}