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
        $this->sendTo($user, 'Welkom', 'emails.welcome', $data);
    }

    public function registered($user)
    {

    }

    /**
    *   Informs the user that he has been accepted to the GSV
    *
    */
    public function accepted($user)
    {

    }
}