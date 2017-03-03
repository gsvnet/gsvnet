<?php namespace GSVnet\Albums\Photos;

use GSVnet\Core\Validator;

class PhotoUpdatorValidator extends Validator
{
    static $rules = [
        'photo' => 'sometimes|image',
        'album_id' => 'required'
    ];

}
