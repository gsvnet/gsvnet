<?php namespace GSV\Helpers\Auth;

use GSV\Helpers\Core\Validator;

class InviteValidator extends Validator
{
    static $rules = [
        'email' => 'required|email',
        'name' => 'required',
    ];
}