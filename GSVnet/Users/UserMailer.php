<?php namespace GSVnet\Users;

use GSVnet\Core\Mailer;
use Config;
use GSVnet\Users\Profiles\UserProfile;

class UserMailer extends Mailer {

    /**
    *   Sends the user a welcome message when he has registered
    */
    public function registered($user)
    {
        $data = [
            'fullName' => $user->present()->fullName,
            'user' => $user
        ];
        
        // Send user a welcome message
        $this->sendTo($user->email, 'Welkom', 'emails.users.welcome', $data);
        // Notify administrators about the new user
        $this->sendTo(Config::get('gsvnet.email.admin'), 'Nieuwe gebruiker', 'emails.admin.registered', $data);
    }

    /**
    *   Informs the user that his account was approved
    */
    public function activated($user)
    {
        $data = [
            'fullname' => $user->present()->fullName,
            'user' => $user
        ];

        // Send user an email informing that his account wasd approved
        $this->sendTo($user->email, 'Account is geactiveerd', 'emails.users.activated', $data);
    }

    /**
    *   Send an email to the user and the membership committee
    */
    public function membership($user, $profile, $input)
    {
        $data = [
            'fullname' => $user->present()->fullName,
            'user' => $user,
            'profile' => $profile,
            'input' => $input
        ];

        $this->sendTo($user->email, 'Aanmelding wordt verwerkt', 'emails.users.join', $data);

        $this->sendTo(
            Config::get('gsvnet.email.membership'),
            'Aanmelding: ' . $user->present()->fullName,
            'emails.membership.application',
            $data
        );
    }

    /**
    *   Informs the user that he has been accepted to the GSV
    */
    public function membershipAccepted($user)
    {
        $data = [
            'fullname' => $user->present()->fullName,
            'user' => $user
        ];

        $this->sendTo($user->email, 'Aanmelding geaccepteerd', 'emails.users.accepted', $data);
    }

    public function updatedByOwner(User $oldUser, User $newUser, UserProfile $oldProfile, UserProfile $newProfile)
    {
        $userFields = [
            'email' => 'Email',
            'firstname' => 'Voornaam',
            'middlename' => 'Tussenvoegsel',
            'lastname' => 'Achternaam',
            'username' => 'Gebruikersnaam'
        ];

        $profileFields = [
            'initials' => 'Initialen',
            'phone' => 'Telefoon',
            'address' => 'Adres',
            'zip_code' => 'Postcode',
            'town' => 'Woonplaats',
            'study' => 'Studie',
            'birthdate' => 'Geboortedatum',
            'gender' => 'Geslacht',
            'student_number' => 'Studentnummer',
            'parent_address' => 'Adres ouders',
            'parent_zip_code' => 'Postcode ouders',
            'parent_town' => 'Woonplaats ouders',
            'parent_phone' => 'Telefoon ouders'
        ];

        $data = [
            'fullname' => $newUser->present()->fullname,
            'oldUser' => $oldUser->toArray(),
            'newUser' => $newUser->toArray(),
            'oldProfile' => $oldProfile->toArray(),
            'newProfile' => $newProfile->toArray(),
            'userFields' => $userFields,
            'profileFields' => $profileFields
        ];

        $subject = 'Profielupdate ' . $data['fullname'];

        $this->sendTo(Config::get('gsvnet.email.profile'), $subject, 'emails.users.profile-update', $data);
    }
}