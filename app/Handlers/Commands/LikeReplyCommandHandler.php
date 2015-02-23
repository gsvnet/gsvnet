<?php namespace GSV\Handlers\Commands;

use GSV\Commands\LikeReplyCommand;
use GSV\Events\ReplyWasLiked;
use GSVnet\Forum\Like;
use GSVnet\Forum\Replies\ReplyRepository;

class LikeReplyCommandHandler {

    private $replies;

    function __construct(ReplyRepository $replies)
    {
        $this->replies = $replies;
    }

    public function handle(LikeReplyCommand $command)
    {
        $like = new Like;
        $like->user_id = $command->userId;

        $reply = $this->replies->getById($command->replyId);

        $this->replies->like($reply, $like);

        event(new ReplyWasLiked($command->replyId, $like->id));
    }
}