<?php namespace GSVnet\Committees;

use GSVnet\Core\Validator;

class MemberValidator extends Validator
{
    static $rules = array(
        'member_id'   => 'exists:users,id',
        'start_date' => 'required|date',
        'end_date' => 'required_if:currently_member,0|date',
    );
}