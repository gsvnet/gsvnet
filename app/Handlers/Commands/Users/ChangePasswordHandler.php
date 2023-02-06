<?php namespace App\Handlers\Commands\Users;

use App\Commands\Users\ChangePassword;
use App\Events\Users\PasswordWasSet;
use App\Helpers\Users\UsersRepository;

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