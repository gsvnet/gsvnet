<?php namespace GSV\Helpers\Users\ValueObjects;

use GSV\Helpers\Core\ValueObject;

class Password extends ValueObject {

    static $rules = [
        'password' => 'required|min:6'
    ];

    private $password;

    public function __construct($password)
    {
        $this->password = $password;

        $this->validate(['password' => $password]);
    }

    public function getEncryptedPassword()
    {
        return bcrypt($this->password);
    }
}