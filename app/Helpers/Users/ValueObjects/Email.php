<?php namespace App\Helpers\Users\ValueObjects;

use App\Helpers\Core\ValueObject;

class Email extends ValueObject {

    private $email;
    private $_email;

    static $rules = [
        'email' => 'required|email'
    ];

    public function __construct($email)
    {
        $this->_email = $email;
        $this->email = $this->sanitize($email);

        $this->validate([
            'email' => $this->email
        ]);
    }

    public function getEmail()
    {
        return $this->email;
    }

    private function sanitize($email)
    {
        return trim($email);
    }
}