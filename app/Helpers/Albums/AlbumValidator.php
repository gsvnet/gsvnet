<?php

namespace App\Helpers\Albums;

use App\Helpers\Core\Validator;

class AlbumValidator extends Validator
{
    public static $rules = [
        'name' => 'required',
        'description' => 'required',
    ];
}
