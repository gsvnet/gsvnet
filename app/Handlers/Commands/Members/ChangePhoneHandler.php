<?php

namespace App\Handlers\Commands\Members;

use App\Commands\Members\ChangePhone;
use App\Events\Members\PhoneNumberWasChanged;
use App\Helpers\Users\Profiles\ProfilesRepository;

class ChangePhoneHandler
{
    private $profiles;

    public function __construct(ProfilesRepository $profiles)
    {
        $this->profiles = $profiles;
    }

    public function handle(ChangePhone $command)
    {
        $profile = $command->user->profile;

        $profile->phone = $command->phone->getPhone();

        $this->profiles->save($profile);

        event(new PhoneNumberWasChanged($command->user, $command->manager));
    }
}
