<?php namespace GSVnet\Users\ValueObjects;

use GSVnet\Core\ValueObject;

class PhoneNumber extends ValueObject {

    protected $phone;

    static $rules = [
        'phone' => 'required'
    ];

    public function __construct($phone)
    {
        $this->phone = $this->sanitize($phone);

        $this->validate([
            'phone' => $this->phone
        ]);
    }

    public function getPhone()
    {
        return $this->phone;
    }

    private function sanitize($phone)
    {
        return trim($phone);
    }
}