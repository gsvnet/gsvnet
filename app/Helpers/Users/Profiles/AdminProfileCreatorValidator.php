<?php

namespace App\Helpers\Users\Profiles;

use App\Helpers\Core\Validator;

class AdminProfileCreatorValidator extends Validator
{
    public static $rules = [
        'user_id' => 'exists:users,id|unique:user_profiles,user_id',
        'year_group_id' => 'exists:year_groups,id',
    ];
}
