<?php

namespace App\Commands\Forum;

use App\Commands\Command;

class DeleteReplyCommand extends Command
{
    public $replyId;

    public function __construct($replyId)
    {
        $this->replyId = $replyId;
    }
}
