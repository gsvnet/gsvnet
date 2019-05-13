<?php namespace GSV\Handlers\Events\Potentials;

use GSV\Events\Potentials\PotentialSignedUp;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Mail\Message;

class PotentialMailer {
    private $mailer;
    private $config;

    function __construct(Mailer $mailer, Repository $config)
    {
        $this->mailer = $mailer;
        $this->config = $config;
    }

    public function sendWelcomeMail(PotentialSignedUp $event)
    {
        $user = $event->user;
        $profile = $user->profile;

        $data = [
            'fullname' => $user->present()->fullName,
            'gender' => $profile->present()->genderLocalized,
            'birthdate' => $profile->present()->birthdayWithYear,
            'user' => $user,
            'profile' => $profile,
            'school' => $event->school,
            'personal_message' => $event->message,
            'startYear' => $event->startYear,
            'parentsEmail' => $event->parentsEmail
        ];

        $novcie = $this->config->get('gsvnet.email.membership');
        $prescie = $this->config->get('gsvnet.email.prescie');
        $webcie = $this->config->get('gsvnet.email.admin');

        $this->mailer->queue('emails.users.join', $data, function(Message $message) use ($user)
        {
            $message->subject('Aanmelding GSV');
            $message->to($user->email, $user->present()->fullName);
        });

        $this->mailer->queue('emails.membership.application', $data, function(Message $message) use ($novcie, $prescie, $webcie)
        {
            $message->to($novcie, 'Novcie');
            $message->cc(array($prescie, $webcie));
            $message->subject('Nieuwe aanmelding');
        });
    }
}