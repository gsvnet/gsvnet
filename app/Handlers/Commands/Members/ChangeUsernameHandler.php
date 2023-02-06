<?php

namespace App\Handlers\Commands\Members;


use App\Commands\Members\ChangeUsername;
use App\Helpers\Users\UsersRepository;

class ChangeUsernameHandler {

    private $users;

    public function __construct(UsersRepository $users)
    {
        $this->users = $users;
    }

    public function handle(ChangeUsername $command)
    {
        $command->user->username = $command->username->getUsername();

        $this->users->save($command->user);
    }
}