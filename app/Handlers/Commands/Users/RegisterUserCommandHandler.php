<?php namespace GSV\Handlers\Commands\Users;

use GSV\Commands\Users\RegisterUserCommand;
use GSV\Events\Users\UserWasRegistered;
use GSVnet\Users\Profiles\ProfilesRepository;
use GSVnet\Users\User;
use GSVnet\Users\UsersRepository;

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
        $user->password = $command->password;
        $user->approved = $command->approved;

        $this->users->save($user);

        if($user->type == User::FORMERMEMBER || $user->type == User::MEMBER)
            $this->profiles->createProfileFor($user);

        event(new UserWasRegistered($user));
    }
}