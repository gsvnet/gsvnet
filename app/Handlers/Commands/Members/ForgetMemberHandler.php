<?php

namespace GSV\Handlers\Commands\Members;

use GSV\Commands\Members\ChangeAddress;
use GSV\Commands\Members\ChangeBirthDay;
use GSV\Commands\Members\ChangeBusiness;
use GSV\Commands\Members\ChangeGender;
use GSV\Commands\Members\ChangeName;
use GSV\Commands\Members\ChangeParentsDetails;
use GSV\Commands\Members\ChangePhone;
use GSV\Commands\Members\ChangeStudy;
use GSV\Commands\Members\ChangeUsername;
use GSV\Commands\Members\ForgetMember;
use GSV\Commands\Users\ChangeEmail;
use GSV\Commands\Users\DeleteProfilePicture;
use GSV\Helpers\Core\Exceptions\ValidationException;
use GSV\Helpers\Newsletters\NewsletterList;
use GSV\Helpers\Newsletters\NewsletterManager;
use GSV\Helpers\Users\Profiles\ProfilesRepository;
use GSV\Helpers\Users\ValueObjects\Address;
use GSV\Helpers\Users\ValueObjects\Business;
use GSV\Helpers\Users\ValueObjects\Date;
use GSV\Helpers\Users\ValueObjects\Email;
use GSV\Helpers\Users\ValueObjects\Gender;
use GSV\Helpers\Users\ValueObjects\Name;
use GSV\Helpers\Users\ValueObjects\OptionalAddress;
use GSV\Helpers\Users\ValueObjects\OptionalEmail;
use GSV\Helpers\Users\ValueObjects\OptionalPhoneNumber;
use GSV\Helpers\Users\ValueObjects\PhoneNumber;
use GSV\Helpers\Users\ValueObjects\Study;
use GSV\Helpers\Users\ValueObjects\Username;

class ForgetMemberHandler
{
    private $profiles;
    private $newsletterManager;

    function __construct(ProfilesRepository $profiles, NewsletterManager $newsletterManager)
    {
        $this->profiles = $profiles;
        $this->newsletterManager = $newsletterManager;
    }

    public function handle(ForgetMember $command)
    {
        $user = $command->user;
        $manager = $command->manager;

        if ($command->name) {
            dispatch(new ChangeName(
                $user,
                $manager,
                new Name(
                    "Onbekend",
                    null,
                    "persoon",
                    null
                )
            ));
        }
        if ($command->username)
            $this->handleUsername($user, $manager);
        if ($command->address) {
            dispatch(new ChangeAddress(
                $user,
                $manager,
                new Address(
                    "Straat 1",
                    "1111AA",
                    "Stad"
                )
            ));
        }
        if ($command->email) {
            $this->newsletterManager->forgetUser($user);
            $this->handleEmail($user, $manager);
        }
        if ($command->profilePicture)
            dispatch(new DeleteProfilePicture($user, $manager));
        if ($command->birthDay)
            dispatch(new ChangeBirthDay($user, $manager, new Date("1966-06-23")));
        if ($command->gender)
            dispatch(new ChangeGender($user, $manager, new Gender(null)));
        if ($command->phone)
            dispatch(new ChangePhone($user, $manager, new PhoneNumber("+31600000000")));
        if ($command->study)
            dispatch(new ChangeStudy($user, $manager, new Study(null, null)));
        if ($command->business) {
            dispatch(new ChangeBusiness(
                $user,
                $manager,
                new Business(null, null, null)
            ));
        }
        if ($command->parents) {
            dispatch(new ChangeParentsDetails(
                $user,
                $manager,
                new OptionalAddress(null, null, null),
                new OptionalPhoneNumber(null),
                new OptionalEmail(null)
            ));
        }
    }

    // Keeps trying to change the username until it finds a unique one.
    private function handleUsername($user, $manager) {
        $newUsername = str_random(15);
        try {
            dispatch(new ChangeUsername($user, $manager, new Username($newUsername)));
        } catch (ValidationException $e) {
            $this->handleUsername($user, $manager);
        }
    }

    // Keeps trying to change the email until it finds a unique one.
    private function handleEmail($user, $manager) {
        $newEmail = str_random(15)."@gsvnet.nl";
        try {
            dispatch(new ChangeEmail($user, $manager, new Email($newEmail)));
        } catch (ValidationException $e) {
            $this->handleEmail($user, $manager);
        }
    }
}