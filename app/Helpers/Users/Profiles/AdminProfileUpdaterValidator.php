<?php namespace App\Helpers\Users\Profiles;

use App\Helpers\Core\Validator;

class AdminProfileUpdaterValidator extends Validator
{
    static $rules = [
        'user_id' => 'exists:users,id'
    ];
}