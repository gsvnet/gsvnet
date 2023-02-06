<?php namespace GSV\Handlers\Commands\Members;

use GSV\Commands\Members\ChangeAddress;
use GSV\Commands\Members\ChangePhone;
use GSV\Events\Members\AddressWasChanged;
use GSV\Events\Members\PhoneNumberWasChanged;
use GSV\Helpers\Users\Profiles\ProfilesRepository;

class ChangePhoneHandler {

    private $profiles;

    function __construct(ProfilesRepository $profiles)
    {
        $this->profiles = $profiles;
    }

    public function handle(ChangePhone $command)
    {
        $profile = $command->user->profile;

        $profile->phone = $command->phone->getPhone();

        $this->profiles->save($profile);

        event(new PhoneNumberWasChanged($command->user, $command->manager));
    }
}