<?php namespace App\Handlers\Commands\Forum;

use App\Commands\Forum\DislikeReplyCommand;
use App\Events\Forum\ReplyWasDisliked;
use App\Helpers\Forum\LikeRepository;

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