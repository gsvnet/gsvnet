<?php namespace App\Handlers\Commands\Members;

use App\Commands\Members\ChangeName;
use App\Events\Members\NameWasChanged;
use App\Helpers\Users\Profiles\ProfilesRepository;
use App\Helpers\Users\UsersRepository;

class ChangeNameHandler {

    private $profiles;
    private $users;

    public function __construct(UsersRepository $users, ProfilesRepository $profiles)
    {
        $this->users = $users;
        $this->profiles = $profiles;
    }

    public function handle(ChangeName $command)
    {
        $profile = $command->user->profile;

        $command->user->profile->initials = $command->name->getInitials();
        $command->user->firstname = $command->name->getFirstName();
        $command->user->middlename = $command->name->getMiddleName();
        $command->user->lastname = $command->name->getLastName();

        $this->users->save($command->user);
        $this->profiles->save($profile);

        event(new NameWasChanged($command->user, $command->manager));
    }
}