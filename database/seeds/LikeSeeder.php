<?php

use Carbon\Carbon;
use GSVnet\Forum\Replies\Reply;
use GSVnet\Forum\Threads\Thread;
use GSVnet\Users\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LikeSeeder extends Seeder
{
    private $userIds;
    private $time;

    public function __construct() {
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
        DB::table('likeable_likes')->truncate();

        $likes = [];

        $this->generateLikes('forum_replies', Reply::class);
        $this->generateLikes('forum_threads', Thread::class);

        DB::table('likeable_likes')->insert($likes);
    }

    private function generateLikes($table, $class) {
        $count = DB::table($table)->count();
        $bar = $this->command->getOutput()->createProgressBar($count);

        DB::table($table)->chunk(100, function($likables) use ($table, $class, $bar) {
            $likes = [];

            foreach ($likables as $likable) {
                $bar->advance();

                $numLikes = rand(0, 40);

                if ($numLikes != 0) {
                    // Silently allow this to be the author of the reply
                    $likers = array_rand(array_flip($this->userIds), $numLikes);

                    if ($numLikes == 1)
                        $likers = [$likers];

                    foreach ($likers as $liker)
                        $likes[] = $this->generateLike($class, $likable->id, $liker);

                    DB::table($table)->where('id', $likable->id)->update(['like_count' => $numLikes]);
                }
            }

            DB::table('likeable_likes')->insert($likes);
        });

        $bar->finish();
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
