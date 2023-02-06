<?php

namespace App\Handlers\Commands\Users;

use App\Commands\Users\RegisterUserCommand;
use App\Events\Users\UserWasRegistered;
use App\Helpers\Users\Profiles\ProfilesRepository;
use App\Helpers\Users\User;
use App\Helpers\Users\UsersRepository;

class RegisterUserCommandHandler
{
    private $users;

    public function __construct(UsersRepository $users, ProfilesRepository $profiles)
    {
        $this->users = $users;
        $this->profiles = $profiles;
    }

    public function handle(RegisterUserCommand $command)
    {
        $user = new User;

        $user->firstname = $command->firstName;
        $user->middlename = $command->middleName;
        $user->lastname = $command->lastName;
        $user->username = $command->userName;
        $user->type = $command->type;
        $user->email = $command->email;
        $user->password = bcrypt($command->password);
        $user->approved = $command->approved;

        $this->users->save($user);

        // Create a profile for potentials, members and former members
        if ($user->type != User::VISITOR && $user->type != User::EXMEMBER) {
            $this->profiles->createProfileFor($user);
        }

        event(new UserWasRegistered($user));
    }
}
