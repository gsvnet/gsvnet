<?php

namespace App\Helpers\Committees\CommitteeMembership;

use App\Helpers\Core\Validator;

class MemberUpdaterValidator extends Validator
{
    public static $rules = [
        'start_date' => 'required|date',
        'end_date' => 'required_if:currently_member,0|date',
    ];
}
