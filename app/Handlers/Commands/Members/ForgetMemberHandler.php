<?php

namespace GSV\Handlers\Commands\Members;


use GSV\Commands\Members\ChangeAddress;
use GSV\Commands\Members\ChangeBirthDay;
use GSV\Commands\Members\ChangeGender;
use GSV\Commands\Members\ChangeParentsDetails;
use GSV\Commands\Members\ChangePhone;
use GSV\Commands\Members\ChangeStudy;
use GSV\Commands\Members\ForgetMember;
use GSV\Commands\Users\ChangeEmail;
use GSVnet\Core\Exceptions\ValidationException;
use GSVnet\Users\Profiles\ProfilesRepository;
use GSVnet\Users\ValueObjects\Address;
use GSVnet\Users\ValueObjects\Date;
use GSVnet\Users\ValueObjects\Email;
use GSVnet\Users\ValueObjects\Gender;
use GSVnet\Users\ValueObjects\OptionalAddress;
use GSVnet\Users\ValueObjects\OptionalEmail;
use GSVnet\Users\ValueObjects\OptionalPhoneNumber;
use GSVnet\Users\ValueObjects\PhoneNumber;
use GSVnet\Users\ValueObjects\Study;

class ForgetMemberHandler
{
    private $profiles;

    function __construct(ProfilesRepository $profiles)
    {
        $this->profiles = $profiles;
    }

    public function handle(ForgetMember $command)
    {
        $user = $command->user;
        $manager = $command->manager;

        dispatch(new ChangeAddress(
            $user,
            $manager,
            new Address(
                $command->address,
                $command->zipCode,
                $command->town
            )
        ));
        $this->handleEmail($user, $manager, $command);
        dispatch(new ChangeBirthDay($user, $manager, new Date($command->birthDay)));
        dispatch(new ChangeGender($user, $manager, new Gender($command->gender)));
        dispatch(new ChangePhone($user, $manager, new PhoneNumber($command->phone)));
        dispatch(new ChangeStudy($user, $manager, new Study($command->study, $command->studentNumber)));
        dispatch(new ChangeParentsDetails(
            $user,
            $manager,
            new OptionalAddress(
                $command->parentAddress,
                $command->parentZipCode,
                $command->parentTown
            ),
            new OptionalPhoneNumber($command->parentPhone),
            new OptionalEmail($command->parentEmail)
        ));
    }

    // Keeps trying to change the email until it finds a unique one.
    private function handleEmail($user, $manager, ForgetMember $command) {
        try {
            dispatch(new ChangeEmail($user, $manager, new Email($command->email)));
        } catch (ValidationException $e) {
            $command->email = str_random(15)."@gsvnet.nl";
            $this->handleEmail($user, $manager, $command);
        }
    }
}