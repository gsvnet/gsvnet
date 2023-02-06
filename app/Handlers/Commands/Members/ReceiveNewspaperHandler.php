<?php namespace GSV\Handlers\Commands\Members;


use GSV\Commands\Members\ReceiveNewspaper;
use GSV\Helpers\Users\Profiles\ProfilesRepository;

class ReceiveNewspaperHandler
{

    function __construct(ProfilesRepository $profiles)
    {
        $this->profiles = $profiles;
    }

    public function handle(ReceiveNewspaper $command)
    {
        $profile = $command->user->profile;
        $profile->receive_newspaper = $command->receive_newspaper;
        $this->profiles->save($profile);
    }
}