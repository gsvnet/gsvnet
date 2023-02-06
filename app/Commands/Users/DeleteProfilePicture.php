<?php

namespace GSV\Commands\Users;


use GSV\Helpers\Users\User;

class DeleteProfilePicture {

    public $user;

    public $manager;

    function __construct(User $user, User $manager)
    {
        $this->user = $user;
        $this->manager = $manager;
    }
}