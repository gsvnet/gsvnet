<?php

namespace App\Helpers\Committees\CommitteeMembership;

use App\Helpers\Core\Validator;

class MemberCreatorValidator extends Validator
{
    public static $rules = [
        'member' => 'required|exists:users,id',
        'committee_id' => 'required|exists:committees,id',
        'start_date' => 'required|date',
        'end_date' => 'required_if:currently_member,0|date',
    ];
}
