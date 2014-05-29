<?php namespace GSVnet\Users;

use GSVnet\Core\Mailer;
use Config;

class UserMailer extends Mailer {

    /**
    *   Sends the user a welcome message when he has registered
    */
    public function registered($user)
    {
        $data = [
            'fullname' => $user->present()->fullName,
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
    public function membership($user)
    {
        $data = [
            'fullname' => $user->present()->fullName,
            'user' => $user
        ];

        $this->sendTo($user->email, 'Aanmelding word verwerkt', 'emails.users.join', $data);

        $this->sendTo(
            Config::get('gsvnet.email.membership'),
            'Aanmelding: ' . $user->present()->fullName,
            'emails.membership.application',
            $data
        );
    }

    /**
    *   Informs the user that he has been accepted to the GSV
    *
    */
    public function membershipAccepted($user)
    {
        $data = [
            'fullname' => $user->present()->fullName,
            'user' => $user
        ];

        $this->sendTo($user->email, 'Aanmelding geaccpeteerd', 'emails.users.accepted', $data);
    }

    /**
    *   Inform the user that it's his or her birthday
    */
    public function birthday($user)
    {
        $data = [
            'fullname' => $user->present()->fullName,
            'user' => $user
        ];
        
        $this->sendTo($user->email, 'Gefeliciteerd met je verjaardag!', 'emails.users.birthday', $data);
    }
}