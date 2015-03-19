<?php namespace GSVnet\Albums\Photos;

use GSVnet\Core\Validator;

class PhotoCreatorValidator extends Validator
{
    static $rules = [
        'photo' => 'required|image',
        'album_id' => 'required'
    ];
}