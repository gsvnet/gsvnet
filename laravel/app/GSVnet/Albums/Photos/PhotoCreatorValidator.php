<?php namespace GSVnet\Albums\Photos;

class PhotoCreatorValidator extends Validator
{
    static $rules = [
        'photo' => 'required|image',
        'album_id' => 'required'
    ];
}