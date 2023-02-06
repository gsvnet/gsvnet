<?php namespace App\Handlers\Commands\Members;


use App\Commands\Members\ReceiveNewspaper;
use App\Helpers\Users\Profiles\ProfilesRepository;

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