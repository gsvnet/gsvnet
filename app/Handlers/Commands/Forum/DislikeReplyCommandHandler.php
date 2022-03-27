<?php namespace GSV\Handlers\Commands\Forum;

use GSV\Commands\Forum\DislikeReplyCommand;
use GSV\Events\Forum\ReplyWasDisliked;
use GSVnet\Forum\LikeRepository;
use GSVnet\Forum\Replies\Reply;
use Illuminate\Support\Facades\DB;

class DislikeReplyCommandHandler {

    private $likes;

    function __construct(LikeRepository $likes)
    {
        $this->likes = $likes;
    }

    public function handle(DislikeReplyCommand $command)
    {
        $this->likes->dislikeReply($command->replyId, $command->userId);

        $toBeDeleted = DB::table('falsible_falselikes')->where('falsible_id', $command->replyId)
            ->where('falsible_type', Reply::class)
            ->orderBy('created_at', 'desc')
            ->first();
        DB::table('falsible_falselikes')->where('id', $toBeDeleted->id)->delete();

        event(new ReplyWasDisliked($command->replyId, $command->userId));
    }
}