<?php namespace GSVnet\Users\ValueObjects;

use GSVnet\Core\ValueObject;

class Address extends ValueObject {

    private $street;
    private $zipCode;
    private $town;
    private $country;

    static $rules = [
        'address' => 'required',
        'zip_code' => 'required',
        'town' => 'required',
        'country' => 'required'
    ];

    public function __construct($street, $zipCode, $town, $country = 'Nederland')
    {
        $this->street = ucfirst(trim($street));
        $this->zipCode = strtoupper(trim($zipCode));
        $this->town = ucfirst(trim($town));
        $this->country = ucfirst(trim($country));

        $this->validate([
            'address' => $this->street,
            'zip_code' => $this->zipCode,
            'town' => $this->town,
            'country' => $this->country,
        ]);
    }

    public function getStreet()
    {
        return $this->street;
    }

    public function getZipCode()
    {
        return $this->zipCode;
    }

    public function getTown()
    {
        return $this->town;
    }

    public function getCountry()
    {
        return $this->country;
    }
}