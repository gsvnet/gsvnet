<?php

namespace App\Helpers\Core;

use Illuminate\Bus\Mailable;
use Illuminate\Bus\Queuable;
use Illuminate\Bus\SerializeModels;
use Illuminate\Bus\ShouldQueue;

class MailableMail extends Mailable implements ShouldQueue
{
    use Queuable, SerializeModels;

    protected $view;

    protected $subject;

    protected $data;

    public function __construct($view, $subject, $data)
    {
        $this->view = $view;
        $this->subject = $subject;
        $this->data = $data;
    }

    public function build()
    {
        return $this->view($this->view)->subject($this->subject)->with($this->data);
    }
}
