<?php

namespace App\Handlers\Commands\Forum;

use App\Commands\Forum\LikeReplyCommand;
use App\Events\Forum\ReplyWasLiked;
use App\Helpers\Forum\Like;
use App\Helpers\Forum\Replies\ReplyRepository;

class LikeReplyCommandHandler
{
    private $replies;

    public function __construct(ReplyRepository $replies)
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
