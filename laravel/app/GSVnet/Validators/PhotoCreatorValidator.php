<?php namespace GSVnet\Validators;

class PhotoCreatorValidator extends Validator
{
    static $rules = [
        'photo' => 'required|image',
        'album_id' => 'required'
    ];
}