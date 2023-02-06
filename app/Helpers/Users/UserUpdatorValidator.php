<?php namespace GSV\Helpers\Users;

use GSV\Helpers\Core\Validator;
use Auth;

class UserUpdatorValidator extends Validator
{
    public static $rules = [
        'email' => 'required|email|unique:users,email'
    ];

    public function forUser($id)
    {
    	self::$rules['email'] = 'required|email|unique:users,email,' . $id;
    }
}