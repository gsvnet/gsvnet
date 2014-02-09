<?php namespace GSVnet\Albums;

class AlbumValidator extends Validator
{
    static $rules = array(
        'name'        => 'required',
        'description' => 'required'
    );
}