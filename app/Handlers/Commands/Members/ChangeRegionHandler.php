<?php

namespace App\Handlers\Commands\Members;

use App\Commands\Members\ChangeRegion;
use App\Events\Members\RegionWasChanged;

class ChangeRegionHandler
{
    public function handle(ChangeRegion $command)
    {
        $command->user->profile->regions()->sync($command->regions);

        event(new RegionWasChanged($command->user, $command->manager));
    }
}
