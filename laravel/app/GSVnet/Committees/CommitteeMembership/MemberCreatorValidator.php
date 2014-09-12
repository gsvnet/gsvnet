<?php namespace GSVnet\Committees\CommitteeMembership;

use GSVnet\Core\Validator;

class MemberCreatorValidator extends Validator
{
    static $rules = array(
        'member_id'   => 'required|exists:users,id',
        'committee_id'   => 'required|exists:committees,id',        
        'start_date' => 'required|date',
        'end_date' => 'required_if:currently_member,0|date',
    );
}