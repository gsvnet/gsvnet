<?php namespace GSVnet\Users;

use GSVnet\Core\Mailer;

class UserMailer extends Mailer {
    public function welcome($user)
    {
        $data = ['user' => $user];
        $this->sendTo($user, 'Welkom', 'emails.welcome', $data);
    }
}