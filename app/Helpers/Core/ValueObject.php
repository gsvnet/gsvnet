<?php namespace GSV\Helpers\Core;

use GSV\Helpers\Core\Exceptions\ValueObjectValidationException;
use Illuminate\Support\Facades\Validator;

class ValueObject {

    static $rules = [];

    protected function validate($data)
    {
        $validator = Validator::make($data, static::$rules);

        if($validator->fails())
        {
            throw new ValueObjectValidationException($validator->messages());
        }
    }
}