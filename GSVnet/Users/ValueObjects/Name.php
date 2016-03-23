<?php namespace GSVnet\Users\ValueObjects;

use GSVnet\Core\ValueObject;

class Name extends ValueObject {

    static $rules = [
        'firstName' => 'required',
        'lastName' => 'required',
    ];

    private $firstName;
    private $middleName;
    private $lastName;

    public function __construct($firstName, $middleName, $lastName)
    {
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