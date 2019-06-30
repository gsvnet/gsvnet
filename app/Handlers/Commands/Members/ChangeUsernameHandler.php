<?php

namespace GSV\Handlers\Commands\Members;


use GSV\Commands\Members\ChangeUsername;
use GSVnet\Users\UsersRepository;

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