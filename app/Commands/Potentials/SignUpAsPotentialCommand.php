<?php

namespace App\Commands\Potentials;

use App\Commands\Command;

class SignUpAsPotentialCommand extends Command
{
    public $firstname;

    public $middlename;

    public $lastname;

    public $gender;

    public $birthdate;

    public $address;

    public $zipCode;

    public $town;

    public $email;

    public $phone;

    public $study;

    public $studentNumber;

    public $studyStartYear;

    public $username;

    public $password;

    public $parentsAddress;

    public $parentsZipCode;

    public $parentsTown;

    public $parentsPhone;

    public $parentsEmail;

    public $message;

    public $school;

    /**
     * SignUpAsPotential constructor.
     */
    public function __construct($firstname, $middlename, $lastname, $gender, $birthdate, $address, $zipCode, $town, $email, $phone, $study, $studentNumber, $studyStartYear, $username, $password, $parentsAddress, $parentsZipCode, $parentsTown, $parentsPhone, $parentsEmail, $message, $school)
    {
        $this->firstname = $firstname;
        $this->middlename = $middlename;
        $this->lastname = $lastname;
        $this->gender = $gender;
        $this->birthdate = $birthdate;
        $this->address = $address;
        $this->zipCode = $zipCode;
        $this->town = $town;
        $this->email = $email;
        $this->phone = $phone;
        $this->study = $study;
        $this->studentNumber = $studentNumber;
        $this->studyStartYear = $studyStartYear;
        $this->username = $username;
        $this->password = $password;
        $this->parentsAddress = $parentsAddress;
        $this->parentsZipCode = $parentsZipCode;
        $this->parentsTown = $parentsTown;
        $this->parentsPhone = $parentsPhone;
        $this->parentsEmail = $parentsEmail;
        $this->message = $message;
        $this->school = $school;
    }
}
