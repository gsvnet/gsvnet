<?php namespace GSV\Helpers\Albums;

use GSV\Helpers\Core\Validator;

class AlbumValidator extends Validator
{
    static $rules = array(
        'name'        => 'required',
        'description' => 'required'
    );
}