<?php namespace App\Handlers\Commands\Members;

use App\Commands\Members\ChangeAddress;
use App\Events\Members\AddressWasChanged;
use App\Helpers\Users\Profiles\ProfilesRepository;

class ChangeAddressHandler {

    private $profiles;

    function __construct(ProfilesRepository $profiles)
    {
        $this->profiles = $profiles;
    }

    public function handle(ChangeAddress $command)
    {
        $profile = $command->user->profile;

        $profile->address = $command->address->getStreet();
        $profile->zip_code = $command->address->getZipCode();
        $profile->town = $command->address->getTown();
        $profile->country = $command->address->getCountry();

        $this->profiles->save($profile);

        event(new AddressWasChanged($command->user, $command->manager));
    }
}