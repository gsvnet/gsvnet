<?php namespace GSVnet\Auth;

use GSVnet\Core\Validator;

class InviteValidator extends Validator
{
    static $rules = [
        'email' => 'required|email',
        'name' => 'required',
    ];
}