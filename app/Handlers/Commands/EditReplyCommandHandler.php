<?php namespace GSV\Handlers\Commands;

use GSV\Commands\EditReplyCommand;
use GSVnet\Forum\Replies\ReplyRepository;

class EditReplyCommandHandler {

    private $replies;

    function __construct(ReplyRepository $replies)
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
