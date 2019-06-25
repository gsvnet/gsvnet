<?php

namespace GSV\Commands\Members;

use GSV\Commands\Command;
use GSVnet\Users\User;

class ForgetMember extends Command {

    public $user;
    public $manager;
    public $address;
    public $zipCode;
    public $town;
    public $email;
    public $birthDay;
    public $gender;
    public $phone;
    public $study;
    public $studentNumber;
    public $parentAddress;
    public $parentZipCode;
    public $parentTown;
    public $parentEmail;
    public $parentPhone;

    function __construct(
        User $user,
        User $manager,
        $address,
        $zipCode,
        $town,
        $email,
        $birthDay,
        $gender,
        $phone,
        $study,
        $studentNumber,
        $parentAddress,
        $parentZipCode,
        $parentTown,
        $parentEmail,
        $parentPhone
    )
    {
        $this->user = $user;
        $this->manager = $manager;
        $this->address = $address;
        $this->zipCode = $zipCode;
        $this->town = $town;
        $this->email = $email;
        $this->birthDay = $birthDay;
        $this->gender = $gender;
        $this->phone = $phone;
        $this->study = $study;
        $this->studentNumber = $studentNumber;
        $this->parentAddress = $parentAddress;
        $this->parentZipCode = $parentZipCode;
        $this->parentTown = $parentTown;
        $this->parentEmail = $parentEmail;
        $this->parentPhone = $parentPhone;
    }
}