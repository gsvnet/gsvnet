<?php namespace GSV\Handlers\Commands\Forum;

use GSV\Commands\Forum\DeleteReplyCommand;
use GSV\Events\Forum\ReplyWasDeleted;
use GSV\Helpers\Forum\Replies\ReplyRepository;

class DeleteReplyCommandHandler {

    private $replies;

    function __construct(ReplyRepository $replies)
    {
        $this->replies = $replies;
    }

    public function handle(DeleteReplyCommand $command)
	{
        $reply = $this->replies->requireById($command->replyId);

        $replyId = $reply->id;
        $threadId = $reply->thread_id;

        $this->replies->delete($reply);

        event(new ReplyWasDeleted($threadId, $replyId));
	}
}
