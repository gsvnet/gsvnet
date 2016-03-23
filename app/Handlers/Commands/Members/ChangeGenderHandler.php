<?php namespace GSV\Handlers\Commands\Members;

use GSV\Commands\Members\ChangeGender;
use GSV\Events\Members\GenderWasChanged;
use GSVnet\Users\Profiles\ProfilesRepository;

class ChangeGenderHandler {

    private $profiles;

    function __construct(ProfilesRepository $profiles)
    {
        $this->profiles = $profiles;
    }

    public function handle(ChangeGender $command)
    {
        $profile = $command->user->profile;
        $profile->gender = $command->gender->getGender();

        $this->profiles->save($profile);

        event(new GenderWasChanged($command->user));
    }
}