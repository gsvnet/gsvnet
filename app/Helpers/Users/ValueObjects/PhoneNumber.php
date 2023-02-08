<?php

namespace App\Helpers\Users\ValueObjects;

use App\Helpers\Core\ValueObject;

class PhoneNumber extends ValueObject
{
    protected $phone;

    public static $rules = [
        'phone' => 'required',
    ];

    public function __construct($phone)
    {
        $this->phone = $this->sanitize($phone);

        $this->validate([
            'phone' => $this->phone,
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
