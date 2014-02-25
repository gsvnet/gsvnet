<?php namespace GSVnet\Users;

use GSVnet\Core\Validator;

class UserCreatorValidator extends Validator
{
    static $rules = [
        'register-username'     => 'required|unique:users,username',
        'register-firstname'    => 'required',
        'register-lastname'     => 'required',
        'register-email'        => 'required|email|unique:users,email',
        'register-password'     => 'required|confirmed'
    ];
}