<?php

namespace App\Helpers\Committees;

use App\Helpers\Core\Validator;

class CommitteeCreatorValidator extends Validator
{
    public static $rules = [
        'name' => 'required',
        'description' => 'required',
        'unique_name' => 'required|unique:committees,unique_name',
    ];
}
