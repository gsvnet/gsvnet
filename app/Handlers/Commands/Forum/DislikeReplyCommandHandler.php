<?php namespace GSV\Handlers\Commands\Forum;

use GSV\Commands\Forum\DislikeReplyCommand;
use GSV\Events\Forum\ReplyWasDisliked;
use GSVnet\Forum\LikeRepository;
use GSVnet\Forum\Replies\ReplyRepository;

class DislikeReplyCommandHandler {

    private $likes;

    function __construct(LikeRepository $likes, ReplyRepository $replies)
    {
        $this->likes = $likes;
        $this->replies = $replies;
    }

    public function handle(DislikeReplyCommand $command)
    {
        $this->likes->dislikeReply($command->replyId, $command->userId);

        $reply = $this->replies->getById($command->replyId);
        $reply->author->getAprilFools()->removeLike();

        event(new ReplyWasDisliked($command->replyId, $command->userId));
    }
}