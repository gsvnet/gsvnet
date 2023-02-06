<?php namespace App\Handlers\Commands\Members;

use App\Commands\Members\ChangeBusiness;
use App\Events\Members\BusinessWasChanged;
use App\Helpers\Users\Profiles\ProfilesRepository;

class ChangeBusinessHandler {

    private $profiles;

    function __construct(ProfilesRepository $profiles)
    {
        $this->profiles = $profiles;
    }

    public function handle(ChangeBusiness $command)
    {
        $profile = $command->user->profile;

        $profile->company = $command->business->getCompany();
        $profile->profession = $command->business->getFunction();
        $profile->business_url = $command->business->getUrl();

        $this->profiles->save($profile);

        event(new BusinessWasChanged($command->user, $command->manager));
    }
}