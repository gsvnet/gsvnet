<?php

namespace App\Helpers\Users\ValueObjects;

use App\Helpers\Core\ValueObject;

class Name extends ValueObject
{
    public static $rules = [
        'firstName' => 'required',
        'lastName' => 'required',
    ];

    private $firstName;

    private $middleName;

    private $lastName;

    private $initials;

    public function __construct($firstName, $middleName, $lastName, $initials)
    {
        $this->initials = trim($initials);
        $this->firstName = $this->sanitizeFirstName($firstName);
        $this->middleName = $this->sanitizeMiddleName($middleName);
        $this->lastName = $this->sanitizeLastName($lastName);

        $this->validate([
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
        ]);
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getMiddleName()
    {
        return $this->middleName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getInitials()
    {
        return $this->initials;
    }

    private function sanitizeFirstName($string)
    {
        return ucfirst(trim($string));
    }

    private function sanitizeMiddleName($string)
    {
        return trim($string);
    }

    private function sanitizeLastName($string)
    {
        return ucfirst(trim($string));
    }
}
