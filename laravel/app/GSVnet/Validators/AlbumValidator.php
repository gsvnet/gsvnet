<?php namespace GSVnet\Validators;

class AlbumValidator extends Validator
{
    static $rules = array(
        'name'        => 'required',
        'description' => 'required'
    );
}