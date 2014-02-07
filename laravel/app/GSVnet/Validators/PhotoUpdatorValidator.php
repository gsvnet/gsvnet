<?php namespace GSVnet\Validators;

class PhotoUpdatorValidator extends Validator
{
    static $rules = [
        'photo' => 'sometimes|image',
        'album_id' => 'required'
    ];

}
