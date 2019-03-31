<?php namespace GSV\Handlers\Commands\Forum;

use GSV\Commands\Forum\LikeReplyCommand;
use GSV\Events\Forum\ReplyWasLiked;
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
        $reply->author->getAprilFools()->receiveLike();

        event(new ReplyWasLiked($command->replyId, $like->id));
    }
}