<?php namespace GSV\Helpers\Users\ValueObjects;

use GSV\Helpers\Core\Exceptions\ValueObjectValidationException;
use GSV\Helpers\Core\ValueObject;
use Illuminate\Support\MessageBag;

class Gender extends ValueObject {

    const FEMALE = 0;
    const MALE = 1;
    const UNKOWN = null;

    private $gender;

    function __construct($gender = null)
    {
        $this->gender = $gender === null ? null : (int) $gender;
        $this->validateGender();
    }

    public function getGender()
    {
        return $this->gender;
    }

    private function validateGender()
    {
        $possibilities = [static::MALE, static::FEMALE, static::UNKOWN];

        if( !in_array($this->gender, $possibilities, true))
        {
            throw new ValueObjectValidationException(new MessageBag([
                'gender' => 'Niet-bestaande sekse'
            ]));
        }
    }
}