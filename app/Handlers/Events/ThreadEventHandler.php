<?php

namespace App\Handlers\Events;

use App\Events\Forum\ReplyWasDeleted;
use App\Events\Forum\ReplyWasDisliked;
use App\Events\Forum\ReplyWasLiked;
use App\Events\Forum\ThreadWasDisliked;
use App\Events\Forum\ThreadWasLiked;
use App\Events\Forum\ThreadWasRepliedTo;
use Illuminate\Contracts\Events\Dispatcher;

class ThreadEventHandler
{
    public function subscribe(Dispatcher $events)
    {
        $events->listen(ThreadWasRepliedTo::class, 'App\Handlers\Events\Forum\UpdateThreadDetails@incrementReplies');
        $events->listen(ThreadWasRepliedTo::class, 'App\Handlers\Events\Forum\UpdateThreadDetails@setNewLastReply');

        $events->listen(ReplyWasDeleted::class, 'App\Handlers\Events\Forum\UpdateThreadDetails@decrementReplies');
        $events->listen(ReplyWasDeleted::class, 'App\Handlers\Events\Forum\UpdateThreadDetails@resetLastReply');

        $events->listen(ReplyWasLiked::class, 'App\Handlers\Events\Forum\UpdateReplyDetails@incrementLikes');
        $events->listen(ReplyWasDisliked::class, 'App\Handlers\Events\Forum\UpdateReplyDetails@decrementLikes');

        $events->listen(ThreadWasLiked::class, 'App\Handlers\Events\Forum\UpdateThreadDetails@incrementLikes');
        $events->listen(ThreadWasDisliked::class, 'App\Handlers\Events\Forum\UpdateThreadDetails@decrementLikes');
    }
}
