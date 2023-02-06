<?php namespace App\Handlers\Commands\Members;

use App\Commands\Members\ChangeBirthDay;
use App\Events\Members\BirthDayWasChanged;
use App\Helpers\Users\Profiles\ProfilesRepository;

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