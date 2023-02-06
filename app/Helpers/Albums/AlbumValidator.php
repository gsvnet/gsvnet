<?php namespace App\Helpers\Albums;

use App\Helpers\Core\Validator;

class AlbumValidator extends Validator
{
    static $rules = array(
        'name'        => 'required',
        'description' => 'required'
    );
}