<?php namespace GSV\Handlers\Commands\Users;

use GSV\Commands\Users\RegisterUserCommand;
use GSV\Events\Users\UserWasRegistered;
use GSV\Helpers\Users\Profiles\ProfilesRepository;
use GSV\Helpers\Users\User;
use GSV\Helpers\Users\UsersRepository;

class RegisterUserCommandHandler {

    private $users;

    public function __construct(UsersRepository $users, ProfilesRepository $profiles)
    {
        $this->users = $users;
        $this->profiles = $profiles;
    }

    function handle(RegisterUserCommand $command)
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
        if($user->type != User::VISITOR && $user->type != User::EXMEMBER)
            $this->profiles->createProfileFor($user);

        event(new UserWasRegistered($user));
    }
}