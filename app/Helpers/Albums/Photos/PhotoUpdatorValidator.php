<?php namespace App\Helpers\Albums\Photos;

use App\Helpers\Core\Validator;

class PhotoUpdatorValidator extends Validator
{
    static $rules = [
        'photo' => 'sometimes|image',
        'album_id' => 'required'
    ];

}
