<?php namespace GSV\Helpers\Albums\Photos;

use GSV\Helpers\Core\Validator;

class PhotoUpdatorValidator extends Validator
{
    static $rules = [
        'photo' => 'sometimes|image',
        'album_id' => 'required'
    ];

}
