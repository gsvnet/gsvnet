<?php namespace App\Helpers\Core;

use App\Helpers\Core\Exceptions\ValidationException;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Factory;

abstract class Validator {

    protected $validator;

    public function __construct(Factory $validator)
    {
        $this->errors = new MessageBag;
        $this->validator = $validator;
    }

    public function validate(array $data)
    {
        $this->before($data);

        $messages = [];
        if(isset(static::$messages))
        {
            $messages = static::$messages;
        }

        $validation = $this->validator->make($data, static::$rules, $messages);

        if ( $validation->fails())
        {
            $this->errors->merge($validation->messages());
        }

        $this->after($data);

        if(! $this->errors->isEmpty())
        {
            throw new ValidationException($this->errors);
        }

        return true;
    }

    protected function before($data){}
    protected function after($data){}

    protected function addError($key, $name)
    {
        $this->errors->add($key, $name);
    }
}