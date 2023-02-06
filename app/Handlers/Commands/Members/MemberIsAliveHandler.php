<?php namespace GSV\Handlers\Commands\Members;


use GSV\Commands\Members\MemberIsAlive;
use GSV\Helpers\Users\Profiles\ProfilesRepository;

class MemberIsAliveHandler
{

    function __construct(ProfilesRepository $profiles)
    {
        $this->profiles = $profiles;
    }

    public function handle(MemberIsAlive $command)
    {
        $profile = $command->user->profile;
        $profile->alive = $command->alive;
        $this->profiles->save($profile);
    }
}