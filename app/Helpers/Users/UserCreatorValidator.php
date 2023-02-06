<?php

namespace App\Helpers\Users;

use App\Helpers\Core\Validator;

class UserCreatorValidator extends Validator
{
    public static $rules = [
        'register-username' => 'required|unique:users,username',
        'register-firstname' => 'required',
        'register-lastname' => 'required',
        'register-email' => 'required|email|unique:users,email',
        'register-password' => 'required|confirmed',
    ];
}
