<?php namespace GSV\Helpers\Users\ValueObjects;

use GSV\Helpers\Core\ValueObject;

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