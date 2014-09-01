<?php namespace GSVnet\Users\Profiles;

use GSVnet\Core\Validator;

class AdminProfileUpdaterValidator extends Validator
{
    static $rules = [
        'user_id' => 'exists:users,id'
    ];
}