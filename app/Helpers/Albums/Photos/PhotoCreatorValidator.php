<?php

namespace App\Helpers\Albums\Photos;

use App\Helpers\Core\Validator;

class PhotoCreatorValidator extends Validator
{
    public static $rules = [
        'photo' => 'required|image',
        'album_id' => 'required',
    ];
}
