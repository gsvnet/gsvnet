<?php namespace App\Helpers\Auth;

use App\Helpers\Core\Validator;

class InviteValidator extends Validator
{
    static $rules = [
        'email' => 'required|email',
        'name' => 'required',
    ];
}