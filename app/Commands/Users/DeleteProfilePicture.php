<?php

namespace App\Commands\Users;

use App\Helpers\Users\User;

class DeleteProfilePicture
{
    public $user;

    public $manager;

    public function __construct(User $user, User $manager)
    {
        $this->user = $user;
        $this->manager = $manager;
    }
}
