<?php

namespace App\Helpers\Core;

use Mail;

abstract class Mailer
{
    public function sendTo($email, $subject, $view, $data = [])
    {
        Mail::to($email)->send(new MailableMail($view, $subject, $data));
    }
}
