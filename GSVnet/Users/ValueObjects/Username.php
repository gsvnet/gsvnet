<?php

namespace GSVnet\Users\ValueObjects;


use GSVnet\Core\ValueObject;

class Username extends ValueObject {

    private $username;

    static $rules = [
        "username" => "required|unique:users,username"
    ];

    public function __construct($username)
    {
        $this->username = $this->sanitize($username);

        $this->validate([
            "username" => $this->username
        ]);
    }

    public function getUsername()
    {
        return $this->username;
    }

    private function sanitize($username)
    {
        return trim($username);
    }
}