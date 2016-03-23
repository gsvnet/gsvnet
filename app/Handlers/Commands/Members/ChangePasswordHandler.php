<?php namespace GSV\Handlers\Commands\Members;

use GSV\Commands\Members\ChangePassword;
use GSV\Events\Members\PasswordWasSet;
use GSVnet\Users\UsersRepository;

class ChangePasswordHandler {

    public function __construct(UsersRepository $users){
        $this->users = $users;
    }

    public function handle(ChangePassword $command)
    {
        $command->user->password = $command->password->getPassword();
        $this->users->save($command->user);

        event(new PasswordWasSet($command->user));
    }
}