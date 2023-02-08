<?php

namespace App\Handlers\Commands\Forum;

use App\Commands\Forum\LikeThreadCommand;
use App\Events\Forum\ThreadWasLiked;
use App\Helpers\Forum\Like;
use App\Helpers\Forum\Threads\ThreadRepository;

class LikeThreadCommandHandler
{
    private $threads;

    public function __construct(ThreadRepository $threads)
    {
        $this->threads = $threads;
    }

    public function handle(LikeThreadCommand $command)
    {
        $like = new Like;
        $like->user_id = $command->userId;

        $reply = $this->threads->getById($command->threadId);

        $this->threads->like($reply, $like);

        event(new ThreadWasLiked($command->threadId, $like->id));
    }
}
