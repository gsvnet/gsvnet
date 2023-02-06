<?php namespace App\Handlers\Commands\Members;

use App\Commands\Members\ChangeAddress;
use App\Commands\Members\ChangeParentsDetails;
use App\Events\Members\AddressWasChanged;
use App\Events\Members\ParentDetailsWereChanged;
use App\Helpers\Users\Profiles\ProfilesRepository;

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
        $profile->parent_email = $command->email->getEmail();

        $this->profiles->save($profile);

        event(new ParentDetailsWereChanged($command->user, $command->manager));
    }
}