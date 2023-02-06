<?php namespace App\Helpers\Users;

use App\Helpers\Core\Validator;

class EmailAndPasswordValidator extends Validator
{
    static $rules = [
        'email' => null,
        'password' => 'sometimes|confirmed'
    ];

    public function forUser(User $user)
    {
        self::$rules['email'] = 'required|email|unique:users,email,' . $user->id;
        return $this;
    }
}