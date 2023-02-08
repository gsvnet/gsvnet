<?php

namespace App\Handlers\Commands\Forum;

use App\Commands\Forum\DislikeThreadCommand;
use App\Events\Forum\ThreadWasDisliked;
use App\Helpers\Forum\LikeRepository;

class DislikeThreadCommandHandler
{
    private $likes;

    public function __construct(LikeRepository $likes)
    {
        $this->likes = $likes;
    }

    public function handle(DislikeThreadCommand $command)
    {
        $this->likes->dislikeThread($command->threadId, $command->userId);

        event(new ThreadWasDisliked($command->threadId, $command->userId));
    }
}
