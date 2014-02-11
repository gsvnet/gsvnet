<?php namespace GSVnet\Albums;

use GSVnet\Core\Validator;

class AlbumValidator extends Validator
{
    static $rules = array(
        'name'        => 'required',
        'description' => 'required'
    );
}