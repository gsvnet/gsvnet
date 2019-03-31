<?php namespace GSV\Handlers\Commands\Forum;

use GSV\Commands\Forum\LikeThreadCommand;
use GSV\Events\Forum\ThreadWasLiked;
use GSVnet\Forum\Like;
use GSVnet\Forum\Threads\ThreadRepository;

class LikeThreadCommandHandler {

    private $threads;

    function __construct(ThreadRepository $threads)
    {
        $this->threads = $threads;
    }

    public function handle(LikeThreadCommand $command)
    {
        $like = new Like;
        $like->user_id = $command->userId;

        $reply = $this->threads->getById($command->threadId);

        $this->threads->like($reply, $like);
        $reply->author->getAprilFools()->receiveLike();

        event(new ThreadWasLiked($command->threadId, $like->id));
    }
}