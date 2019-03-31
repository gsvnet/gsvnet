<?php namespace GSV\Handlers\Commands\Forum;

use GSV\Commands\Forum\DislikeThreadCommand;
use GSV\Events\Forum\ThreadWasDisliked;
use GSVnet\Forum\LikeRepository;
use GSVnet\Forum\Threads\ThreadRepository;

class DislikeThreadCommandHandler {

    private $likes;
    private $threads;

    function __construct(LikeRepository $likes, ThreadRepository $threads)
    {
        $this->likes = $likes;
        $this->threads = $threads;
    }

    public function handle(DislikeThreadCommand $command)
    {
        $this->likes->dislikeThread($command->threadId, $command->userId);
        $reply = $this->threads->getById($command->threadId);
        $reply->author->getAprilFools()->removeLike();

        event(new ThreadWasDisliked($command->threadId, $command->userId));
    }

}