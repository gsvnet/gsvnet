<?php namespace GSV\Helpers\Users\ValueObjects;

use Carbon\Carbon;
use GSV\Helpers\Core\Exceptions\ValueObjectValidationException;
use GSV\Helpers\Core\ValueObject;
use Illuminate\Support\MessageBag;

class Date extends ValueObject {

    private $date;

    static $rules;

    function __construct($dateString)
    {
        try {
            $this->date = Carbon::createFromFormat('Y-m-d', $dateString);
        } catch(\Exception $e)
        {
            $this->throwError('Invalid date');
        }

        $this->validateDate();
    }

    private function validateDate()
    {
        $minimum = Carbon::createFromDate(1900);

        if($this->date->lt($minimum))
        {
            $this->throwError('Invalid date');
        }
    }

    public function asCarbonObject()
    {
        return $this->date;
    }

    private function throwError($message)
    {
        throw new ValueObjectValidationException(new MessageBag([
            'date' => $message
        ]));
    }
}