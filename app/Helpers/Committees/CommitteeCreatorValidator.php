<?php namespace GSV\Helpers\Committees;

use GSV\Helpers\Core\Validator;

class CommitteeCreatorValidator extends Validator
{
    static $rules = array(
        'name'        => 'required',
        'description' => 'required',
        'unique_name' => 'required|unique:committees,unique_name'
    );
}