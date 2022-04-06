<?php

use Carbon\Carbon;
use GSVnet\Forum\Replies\Reply;
use GSVnet\Forum\Threads\Thread;
use GSVnet\Users\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LikeSeeder extends Seeder
{
    private $replies;
    private $threads;
    private $userIds;
    private $time;

    public function __construct() {
        $this->replies = Reply::all();
        $this->threads = Thread::all();
        $this->userIds = User::lists('id')->all();
        $this->time = Carbon::now();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $likes = [];

        $this->generateLikes($this->replies);
        $this->generateLikes($this->threads);

        DB::table('likeable_likes')->insert($likes);
    }

    private function generateLikes($collection) {
        $likes = [];

        foreach ($collection as $likable_item) {
            $numLikes = rand(2, 10);
            // Silently allow this to be the author of the reply
            $likers = array_rand(array_flip($this->userIds), $numLikes);

            foreach ($likers as $liker)
                $likes[] = $this->generateLike(get_class($likable_item), $likable_item->id, $liker);

            $likable_item->like_count = $numLikes;
            $likable_item->save();
        }

        DB::table('likeable_likes')->insert($likes);
    }

    private function generateLike($likable_type, $likable_id, $liker) {
        return [
            'likable_id' => $likable_id,
            'likable_type' => $likable_type,
            'user_id' => $liker,
            'created_at' => $this->time,
            'updated_at' => $this->time
        ];
    }
}
