<?php

namespace App\Helpers\Core\Exceptions;

class ValidationException extends \Exception
{
    /**
     * @var string
     */
    protected $errors;

    /**
     * @param  string  $errors
     */
    public function __construct(string $errors)
    {
        $this->errors = $errors;
    }

    /**
     * Fetch validation errors
     *
     * @return string
     */
    public function getErrors(): string
    {
        return $this->errors;
    }
}
