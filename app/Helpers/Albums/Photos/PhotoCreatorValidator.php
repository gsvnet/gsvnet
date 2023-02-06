<?php namespace GSV\Helpers\Albums\Photos;

use GSV\Helpers\Core\Validator;

class PhotoCreatorValidator extends Validator
{
    static $rules = [
        'photo' => 'required|image',
        'album_id' => 'required'
    ];
}