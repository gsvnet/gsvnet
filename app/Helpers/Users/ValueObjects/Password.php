<?php

namespace App\Helpers\Users\ValueObjects;

use App\Helpers\Core\ValueObject;
use Illuminate\Support\Facades\Hash;

class Password extends ValueObject
{
    public static $rules = [
        'password' => 'required|min:6',
    ];

    private $password;

    public function __construct($password)
    {
        $this->password = $password;

        $this->validate(['password' => $password]);
    }

    public function getEncryptedPassword()
    {
        return Hash::make($this->password);
    }
}
