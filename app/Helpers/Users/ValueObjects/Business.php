<?php namespace GSV\Helpers\Users\ValueObjects;

use GSV\Helpers\Core\ValueObject;

class Business extends ValueObject {

    private $company;
    private $function;
    private $url;

    function __construct($company, $function, $url)
    {
        $this->company = ucfirst(trim($company));
        $this->function = trim($function);
        $this->url = trim($url);
    }

    public function getCompany()
    {
        return $this->company;
    }

    public function getFunction()
    {
        return $this->function;
    }

    public function getUrl()
    {
        return $this->url;
    }
}