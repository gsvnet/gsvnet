<?php namespace GSVnet\Albums\Photos;

class PhotoUpdatorValidator extends Validator
{
    static $rules = [
        'photo' => 'sometimes|image',
        'album_id' => 'required'
    ];

}
