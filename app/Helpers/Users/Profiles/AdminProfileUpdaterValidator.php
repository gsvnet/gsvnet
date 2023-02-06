<?php namespace GSV\Helpers\Users\Profiles;

use GSV\Helpers\Core\Validator;

class AdminProfileUpdaterValidator extends Validator
{
    static $rules = [
        'user_id' => 'exists:users,id'
    ];
}