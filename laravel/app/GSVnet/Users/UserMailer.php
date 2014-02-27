<?php namespace GSVnet\Users;

use GSVnet\Core\Mailer;

class UserMailer extends Mailer {

    /**
    *   Send the user an approve mail
    */
    public function approve($user)
    {

    }

    public function welcome($user)
    {
        $data = ['user' => $user];
        $this->sendTo($user, 'Welkom', 'emails.users.welcome', $data);
    }

    public function join($user)
    {
        $data = ['user' => $user];
        $this->sendTo($user, 'Aanmelding word verwerkt', 'emails.users.join', $data);

        $this->sendTo($senate, 'Aanmelding: ' $user->full_name, 'emails.users.application', $data);
    }

    /**
    *   Informs the user that he has been accepted to the GSV
    *
    */
    public function accepted($user)
    {
        $data = ['user' => $user];
        $this->sendTo($user, 'Welkom', 'emails.users.accepted', $data);
    }
}