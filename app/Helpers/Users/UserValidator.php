<?php namespace GSV\Helpers\Users;

use GSV\Helpers\Core\Validator;

class UserValidator extends Validator
{
    static $rules = [
        'username' => 'required',
        'firstname' => 'required',
        'lastname' => 'required',
        'email' => 'required',
        'password' => 'sometimes|confirmed'
    ];
}