<?php namespace GSV\Handlers\Commands\Users;

use GSV\Commands\Users\ChangePassword;
use GSV\Events\Users\PasswordWasSet;
use GSVnet\Users\UsersRepository;

class ChangePasswordHandler {

    public function __construct(UsersRepository $users){
        $this->users = $users;
    }

    public function handle(ChangePassword $command)
    {
        $command->user->password = $command->password->getEncryptedPassword();
        $this->users->save($command->user);

        event(new PasswordWasSet($command->user));
    }
}