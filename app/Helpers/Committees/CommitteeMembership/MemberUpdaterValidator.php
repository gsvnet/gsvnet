<?php namespace GSV\Helpers\Committees\CommitteeMembership;

use GSV\Helpers\Core\Validator;

class MemberUpdaterValidator extends Validator
{
    static $rules = array(  
        'start_date' => 'required|date',
        'end_date' => 'required_if:currently_member,0|date',
    );
}