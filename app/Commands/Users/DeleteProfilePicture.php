<?php

namespace GSV\Commands\Users;


use GSVnet\Users\User;

class DeleteProfilePicture {

    public $user;

    public $manager;

    function __construct(User $user, User $manager)
    {
        $this->user = $user;
        $this->manager = $manager;
    }
}