<?php namespace GSVnet\Users;

use GSVnet\Core\Mailer;
use Config;

class UserMailer extends Mailer {

    /**
    *   Send the user an approve mail
    */
    public function approve($user)
    {

    }

    /**
    *   Sends the user a welcome message when he has registered
    */
    public function welcome($user)
    {
        $data = ['user' => $user];
        // Send user a welcome message
        $this->sendTo($user->email, 'Welkom', 'emails.users.welcome', $data);
        // Notify administrators about the new user
        $this->sendTo(Config::get('gsvnet.email.admin'), 'Nieuwe gebruiker', 'emails.admin.registered', $data);
    }

    public function join($user)
    {
        $data = ['user' => $user];
        $this->sendTo($user->email, 'Aanmelding word verwerkt', 'emails.users.join', $data);

        $this->sendTo($senate, 'Aanmelding: ' . $user->full_name, 'emails.users.application', $data);
    }

    /**
    *   Informs the user that he has been accepted to the GSV
    *
    */
    public function membershipAccepted($user)
    {
        $data = ['user' => $user];
        $this->sendTo($user->email, 'Welkom', 'emails.users.accepted', $data);
    }

    /**
    *   Inform the user that it's his or her birthday
    */
    public function birthday($user)
    {
        $data = ['user' => $user];
        $this->sendTo($user->email, 'Gefeliciteerd met je verjaardag!', 'emails.users.birthday', $data);
    }
}