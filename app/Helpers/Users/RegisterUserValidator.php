<?php namespace GSV\Helpers\Users;

use GSV\Helpers\Core\Validator;

class RegisterUserValidator extends Validator {
    static $rules = [
        'username' => 'required|unique:users,username',
        'firstname' => 'required',
        'lastname' => 'required',
        'email' => 'required|unique:users,email',
        'password' => 'sometimes|confirmed'
    ];
}