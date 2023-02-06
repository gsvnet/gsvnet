<?php namespace App\Helpers\Committees;

use App\Helpers\Core\Validator;

class CommitteeCreatorValidator extends Validator
{
    static $rules = array(
        'name'        => 'required',
        'description' => 'required',
        'unique_name' => 'required|unique:committees,unique_name'
    );
}