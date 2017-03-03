<?php namespace GSV\Handlers\Commands\Members;

use GSV\Commands\Members\ChangeYearGroup;
use GSV\Events\Members\YearGroupWasChanged;

class ChangeYearGroupHandler {

    public function handle(ChangeYearGroup $command)
    {
        $profile = $command->user->profile;

        $profile->yearGroup()->associate($command->yearGroup);

        $profile->save();

        event(new YearGroupWasChanged($command->user, $command->manager));
    }
}