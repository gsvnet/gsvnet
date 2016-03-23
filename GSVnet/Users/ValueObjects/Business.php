<?php namespace GSVnet\Core\ValueObjects;

use GSVnet\Core\ValueObjects\ValueObject;

class Business extends ValueObject {

    private $company;
    private $function;

    function __construct($company, $function)
    {
        $this->company = ucfirst(trim($company));
        $this->function = ucfirst(trim($function));
    }

    public function getCompany()
    {
        return $this->company;
    }

    public function getFunction()
    {
        return $this->function;
    }
}