<?php namespace GSV\Handlers\Commands\Members;

use GSV\Commands\Members\ChangeBirthDay;
use GSV\Events\Members\BirthDayWasChanged;
use GSVnet\Users\Profiles\ProfilesRepository;

class ChangeBirthDayHandler {

    private $profiles;

    public function __construct(ProfilesRepository $profiles)
    {
        $this->profiles = $profiles;
    }

    public function handle(ChangeBirthDay $command)
    {
        $profile = $command->user->profile;
        $profile->birthdate = $command->birthday->asCarbonObject();
        $this->profiles->save($profile);

        event(new BirthDayWasChanged($command->user, $command->manager));
    }
}