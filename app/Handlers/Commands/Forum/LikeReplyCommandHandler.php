<?php namespace GSV\Handlers\Commands\Forum;

use GSV\Commands\Forum\LikeReplyCommand;
use GSV\Events\Forum\ReplyWasLiked;
use GSVnet\Forum\Falselike;
use GSVnet\Forum\Like;
use GSVnet\Forum\Replies\ReplyRepository;
use GSVnet\Users\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

        $reply = $this->replies->getByIdWithFalselikeUsers($command->replyId);

        $this->replies->like($reply, $like);

        // Create a false like
        $falselikes = $reply->falselikes;
        $false_ids = $falselikes->map(function($falselike, $key) {
            return $falselike->user->id;
        });
        $false_ids = $false_ids->toArray();

        $all_ids = DB::table('users')->where('type', User::MEMBER)->pluck('id');

        $filtered_ids = array_diff($all_ids, $false_ids);

        $rand_id = $filtered_ids[array_rand($filtered_ids)];

        $falselike = new Falselike;
        $falselike->user_id = $rand_id;
        $reply->falselikes()->save($falselike);

        event(new ReplyWasLiked($command->replyId, $like->id));
    }
}