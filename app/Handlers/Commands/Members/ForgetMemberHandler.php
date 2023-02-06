<?php

namespace App\Handlers\Commands\Members;

use App\Commands\Members\ChangeAddress;
use App\Commands\Members\ChangeBirthDay;
use App\Commands\Members\ChangeBusiness;
use App\Commands\Members\ChangeGender;
use App\Commands\Members\ChangeName;
use App\Commands\Members\ChangeParentsDetails;
use App\Commands\Members\ChangePhone;
use App\Commands\Members\ChangeStudy;
use App\Commands\Members\ChangeUsername;
use App\Commands\Members\ForgetMember;
use App\Commands\Users\ChangeEmail;
use App\Commands\Users\DeleteProfilePicture;
use App\Helpers\Core\Exceptions\ValidationException;
use App\Helpers\Newsletters\NewsletterManager;
use App\Helpers\Users\Profiles\ProfilesRepository;
use App\Helpers\Users\ValueObjects\Address;
use App\Helpers\Users\ValueObjects\Business;
use App\Helpers\Users\ValueObjects\Date;
use App\Helpers\Users\ValueObjects\Email;
use App\Helpers\Users\ValueObjects\Gender;
use App\Helpers\Users\ValueObjects\Name;
use App\Helpers\Users\ValueObjects\OptionalAddress;
use App\Helpers\Users\ValueObjects\OptionalEmail;
use App\Helpers\Users\ValueObjects\OptionalPhoneNumber;
use App\Helpers\Users\ValueObjects\PhoneNumber;
use App\Helpers\Users\ValueObjects\Study;
use App\Helpers\Users\ValueObjects\Username;

class ForgetMemberHandler
{
    private $profiles;

    private $newsletterManager;

    public function __construct(ProfilesRepository $profiles, NewsletterManager $newsletterManager)
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
                    'Onbekend',
                    null,
                    'persoon',
                    null
                )
            ));
        }
        if ($command->username) {
            $this->handleUsername($user, $manager);
        }
        if ($command->address) {
            dispatch(new ChangeAddress(
                $user,
                $manager,
                new Address(
                    'Straat 1',
                    '1111AA',
                    'Stad'
                )
            ));
        }
        if ($command->email) {
            $this->newsletterManager->forgetUser($user);
            $this->handleEmail($user, $manager);
        }
        if ($command->profilePicture) {
            dispatch(new DeleteProfilePicture($user, $manager));
        }
        if ($command->birthDay) {
            dispatch(new ChangeBirthDay($user, $manager, new Date('1966-06-23')));
        }
        if ($command->gender) {
            dispatch(new ChangeGender($user, $manager, new Gender(null)));
        }
        if ($command->phone) {
            dispatch(new ChangePhone($user, $manager, new PhoneNumber('+31600000000')));
        }
        if ($command->study) {
            dispatch(new ChangeStudy($user, $manager, new Study(null, null)));
        }
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
    private function handleUsername($user, $manager)
    {
        $newUsername = str_random(15);
        try {
            dispatch(new ChangeUsername($user, $manager, new Username($newUsername)));
        } catch (ValidationException $e) {
            $this->handleUsername($user, $manager);
        }
    }

    // Keeps trying to change the email until it finds a unique one.
    private function handleEmail($user, $manager)
    {
        $newEmail = str_random(15).'@gsvnet.nl';
        try {
            dispatch(new ChangeEmail($user, $manager, new Email($newEmail)));
        } catch (ValidationException $e) {
            $this->handleEmail($user, $manager);
        }
    }
}
