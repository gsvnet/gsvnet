<?php namespace GSVnet\Users\Profiles;

use GSVnet\Core\Validator;

class AdminProfileCreatorValidator extends Validator
{
    static $rules = [
        'user_id' => 'exists:users,id|unique:user_profiles,user_id',
        'year_group_id' => 'exists:year_groups,id',
        'region' => 'integer'
    ];
}