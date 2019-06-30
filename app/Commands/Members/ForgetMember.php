<?php

namespace GSV\Commands\Members;

use GSV\Commands\Command;
use GSVnet\Users\User;
use Illuminate\Http\Request;

class ForgetMember extends Command {

    public $user;
    public $manager;
    public $name;
    public $username;
    public $address;
    public $email;
    public $profilePicture;
    public $birthDay;
    public $gender;
    public $phone;
    public $study;
    public $business;
    public $parents;

    function __construct(
        User $user,
        User $manager,
        $name,
        $username,
        $address,
        $email,
        $profilePicture,
        $birthDay,
        $gender,
        $phone,
        $study,
        $business,
        $parents
    )
    {
        $this->user = $user;
        $this->manager = $manager;
        $this->name = $name;
        $this->username = $username;
        $this->address = $address;
        $this->email = $email;
        $this->profilePicture = $profilePicture;
        $this->birthDay = $birthDay;
        $this->gender = $gender;
        $this->phone = $phone;
        $this->study = $study;
        $this->business = $business;
        $this->parents = $parents;
    }

    static function fromForm(Request $request, User $user)
    {
        return new self(
            $user,
            $request->user(),
            $request->get('name'),
            $request->get('username'),
            $request->get('address'),
            $request->get('email'),
            $request->get('profilePicture'),
            $request->get('birthDay'),
            $request->get('gender'),
            $request->get('phone'),
            $request->get('study'),
            $request->get('business'),
            $request->get('parents')
        );
    }
}