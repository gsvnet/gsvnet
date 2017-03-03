<?php namespace GSV\Handlers\Commands\Members;

use GSV\Commands\Members\ChangeRegion;
use GSV\Events\Members\RegionWasChanged;

class ChangeRegionHandler {

    public function handle(ChangeRegion $command)
    {
        $command->user->profile->regions()->sync($command->regions);

        event(new RegionWasChanged($command->user, $command->manager));
    }
}