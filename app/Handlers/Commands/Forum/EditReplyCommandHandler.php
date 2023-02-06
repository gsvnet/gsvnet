<?php

namespace App\Handlers\Commands\Forum;

use App\Commands\Forum\EditReplyCommand;
use App\Helpers\Forum\Replies\ReplyRepository;

class EditReplyCommandHandler
{
    private $replies;

    public function __construct(ReplyRepository $replies)
    {
        $this->replies = $replies;
    }

    public function handle(EditReplyCommand $command)
    {
        $reply = $this->replies->getById($command->replyId);
        $reply->body = $command->reply;

        $this->replies->save($reply);
    }
}
