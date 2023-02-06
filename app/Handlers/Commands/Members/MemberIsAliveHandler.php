<?php namespace App\Handlers\Commands\Members;


use App\Commands\Members\MemberIsAlive;
use App\Helpers\Users\Profiles\ProfilesRepository;

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