<?php namespace GSV\Helpers\Users\Profiles;

use GSV\Helpers\Core\Validator;

class AdminProfileCreatorValidator extends Validator
{
    static $rules = [
        'user_id' => 'exists:users,id|unique:user_profiles,user_id',
        'year_group_id' => 'exists:year_groups,id'
    ];
}