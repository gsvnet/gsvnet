<?php namespace GSV\Handlers\Commands;

use GSV\Commands\DislikeThreadCommand;
use GSV\Events\ThreadWasDisliked;
use GSVnet\Forum\LikeRepository;

class DislikeThreadCommandHandler {

    private $likes;

    function __construct(LikeRepository $likes)
    {
        $this->likes = $likes;
    }

    public function handle(DislikeThreadCommand $command)
    {
        $this->likes->dislikeThread($command->threadId, $command->userId);

        event(new ThreadWasDisliked($command->threadId, $command->userId));
    }

}