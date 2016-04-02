<?php namespace GSV\Handlers\Commands\Members;

use GSV\Commands\Members\ChangeRegion;
use GSV\Events\Members\RegionWasChanged;
use GSVnet\Users\Profiles\ProfilesRepository;

class ChangeRegionHandler
{
    private $profiles;

    public function __construct(ProfilesRepository $profiles)
    {
        $this->profiles = $profiles;
    }

    public function handle(ChangeRegion $command)
    {
        $profile = $command->user->profile;

        $profile->region = $command->region->getRegion();

        $this->profiles->save($profile);

        event(new RegionWasChanged($command->user, $command->manager));
    }
}