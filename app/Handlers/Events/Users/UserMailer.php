<?php namespace App\Handlers\Events\Users;

use App\Events\Users\UserWasRegistered;
use App\Helpers\Users\User;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Mail\Mailer;

class UserMailer {
    private $mailer;
    private $config;

    function __construct(Mailer $mailer, Repository $config)
    {
        $this->mailer = $mailer;
        $this->config = $config;
    }

    public function sendWelcomeEmail(UserWasRegistered $event)
    {
        $user = $event->user;
        $data = compact('user');

        // If the user is already approved, we assume an administrator has registered him
        // and we'll not inform anybody
        if($user->approved)
            return;

        $this->mailer->send('emails.users.welcome', $data, function($message) use ($user)
        {
            $message->to($user->email, $user->present()->fullName)->subject('Welkom!');
        });

        $adminEmail = $this->config->get('gsvnet.email.admin');

        $this->mailer->send('emails.admin.registered', $data, function($message) use ($adminEmail)
        {
            $message->to($adminEmail, 'Webcie')->subject('Nieuwe gebruiker');
        });
    }

    public function notifyReunist(UserWasRegistered $event)
    {
        $user = $event->user;
        if($user->type != User::REUNIST)
            return;

        $data = [
            'user' => $user,
            'fullName' => $user->present()->fullName
        ];

        $this->mailer->send('emails.users.former-member-notification', $data, function($message) use ($user)
        {
            $message->to($user->email, $user->present()->fullName)
                ->subject('Welkom op GSVnet')
                ->from('malversacie@gsvnet.nl', 'Malversacie van de GSV');
        });
    }
}