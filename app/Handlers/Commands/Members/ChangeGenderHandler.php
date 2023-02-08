<?php

namespace App\Handlers\Commands\Members;

use App\Commands\Members\ChangeGender;
use App\Events\Members\GenderWasChanged;
use App\Helpers\Users\Profiles\ProfilesRepository;

class ChangeGenderHandler
{
    private $profiles;

    public function __construct(ProfilesRepository $profiles)
    {
        $this->profiles = $profiles;
    }

    public function handle(ChangeGender $command)
    {
        $profile = $command->user->profile;
        $profile->gender = $command->gender->getGender();

        $this->profiles->save($profile);

        event(new GenderWasChanged($command->user, $command->manager));
    }
}
