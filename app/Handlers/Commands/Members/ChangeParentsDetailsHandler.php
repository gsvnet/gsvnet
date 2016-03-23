<?php namespace GSV\Handlers\Commands\Members;

use GSV\Commands\Members\ChangeAddress;
use GSV\Commands\Members\ChangeParentsDetails;
use GSV\Events\Members\AddressWasChanged;
use GSV\Events\Members\ParentDetailsWereChanged;
use GSVnet\Users\Profiles\ProfilesRepository;

class ChangeParentsDetailsHandler {

    private $profiles;

    function __construct(ProfilesRepository $profiles)
    {
        $this->profiles = $profiles;
    }

    public function handle(ChangeParentsDetails $command)
    {
        $profile = $command->user->profile;

        $profile->parent_address = $command->address->getStreet();
        $profile->parent_zip_code = $command->address->getZipCode();
        $profile->parent_town = $command->address->getTown();
//        $profile->parent_country = $command->address->getCountry(); // Parent country is not supported currently
        $profile->parent_phone = $command->phone->getPhone();

        $this->profiles->save($profile);

        event(new ParentDetailsWereChanged($command->user));
    }
}