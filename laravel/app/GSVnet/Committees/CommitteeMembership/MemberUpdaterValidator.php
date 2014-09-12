<?php namespace GSVnet\Committees\CommitteeMembership;

use GSVnet\Core\Validator;

class MemberUpdaterValidator extends Validator
{
    static $rules = array(  
        'start_date' => 'required|date',
        'end_date' => 'required_if:currently_member,0|date',
    );
}