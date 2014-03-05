<?php namespace GSVnet\Core;

use Mail;

abstract class Mailer {

    public function sendTo($email, $subject, $view, $data = [])
    {
        Mail::queue($view, $data, function($message) use($email, $subject)
        {
            if (is_array($email))
            {
                foreach ($email as $m)
                {
                    $message->to($m)->subject($subject);
                }
            } else {
                $message->to($email)->subject($subject);
            }
        });
    }

}