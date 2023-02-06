<?php

namespace App\Helpers\Senates;

use App\Helpers\Core\Validator;

class SenateValidator extends Validator
{
    public static $rules = [
        'name' => 'required',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
    ];
}
