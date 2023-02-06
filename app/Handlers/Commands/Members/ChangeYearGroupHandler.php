<?php namespace App\Handlers\Commands\Members;

use App\Commands\Members\ChangeYearGroup;
use App\Events\Members\YearGroupWasChanged;

class ChangeYearGroupHandler {

    public function handle(ChangeYearGroup $command)
    {
        $profile = $command->user->profile;

        $profile->yearGroup()->associate($command->yearGroup);

        $profile->save();

        event(new YearGroupWasChanged($command->user, $command->manager));
    }
}