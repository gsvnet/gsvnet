<?php namespace App\Helpers\Users\ValueObjects;

use Carbon\Carbon;
use Exception;
use App\Helpers\Core\Exceptions\ValueObjectValidationException;
use App\Helpers\Core\ValueObject;
use Illuminate\Support\MessageBag;

class NullableDate extends ValueObject
{
    private $date = null;

    function __construct($date = null)
    {
        if (is_null($date)) {
            return;
        }

        try {
            $this->date = Carbon::createFromFormat('Y-m-d', $date);
        } catch (Exception $e) {
            $this->throwError('Invalid date');
        }
    }

    public function getDate()
    {
        return $this->date;
    }

    public function asString()
    {
        return $this->date ? $this->date->format('Y-m-d') : null;
    }

    private function throwError($message)
    {
        throw new ValueObjectValidationException(new MessageBag([
            'date' => $message
        ]));
    }
}