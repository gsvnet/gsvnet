<?php namespace GSVnet\Committees;

use GSVnet\Core\Validator;

class CommitteeValidator extends Validator
{
    static $rules = array(
        'name'        => 'required',
        'description' => 'required'
    );
}