<?php namespace GSV\Commands\Users;

use GSV\Commands\Command;

class RegisterUserCommand extends Command {

    public $firstName;
    public $middleName;
    public $lastName;
    public $userName;
    public $type;
    public $email;
    public $password;
    public $approved;

    function __construct($firstName, $middleName, $lastName, $userName, $type, $email, $password, $approved)
    {
        $this->firstName = $firstName;
        $this->middleName = $middleName;
        $this->lastName = $lastName;
        $this->userName = $userName;
        $this->type = $type;
        $this->email = $email;
        $this->password = $password;
        $this->approved = $approved;
    }
}