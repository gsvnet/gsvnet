<?php namespace GSV\Handlers\Commands\Members;

use GSV\Commands\Members\ChangeAlumniStatus;
use GSV\Events\Members\AlumniStatusWasChanged;
use GSVnet\Users\Profiles\ProfilesRepository;

class ChangeAlumniStatusHandler
{
    private $profiles;

    public function __construct(ProfilesRepository $profiles)
    {
        $this->profiles = $profiles;
    }

    public function handle(ChangeAlumniStatus $command)
    {
        $profile = $command->user->profile;

        $profile->reunist = $command->status->isAlumni();

        $this->profiles->save($profile);

        event(new AlumniStatusWasChanged($command->user, $command->manager));
    }

}