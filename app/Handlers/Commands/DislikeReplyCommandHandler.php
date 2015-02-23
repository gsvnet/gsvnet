<?php namespace GSV\Handlers\Commands;

use GSV\Commands\DislikeReplyCommand;
use GSV\Events\ReplyWasDisliked;
use GSVnet\Forum\LikeRepository;
use GSVnet\Forum\Replies\ReplyRepository;

class DislikeReplyCommandHandler {

    private $likes;

    function __construct(LikeRepository $likes)
    {
        $this->likes = $likes;
    }

    public function handle(DislikeReplyCommand $command)
    {
        $this->likes->dislikeReply($command->replyId, $command->userId);

        event(new ReplyWasDisliked($command->replyId, $command->userId));
    }
}