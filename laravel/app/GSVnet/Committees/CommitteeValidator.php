<?php namespace GSVnet\Committees;

use GSVnet\Core\Validator;

class CommitteeValidator extends Validator
{
    static $rules = array(
        'name'        => 'required',
        'description' => 'required',
        'start_date' => 'required|date',
        'end_date' => 'required_if:currently_member,0|date',
    );
}