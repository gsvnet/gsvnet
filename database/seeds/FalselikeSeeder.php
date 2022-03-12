<?php

use Carbon\Carbon;
use GSVnet\Forum\Falselike;
use GSVnet\Forum\Like;
use GSVnet\Forum\Threads\Thread;
use GSVnet\Forum\Replies\Reply;
use GSVnet\Users\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FalselikeSeeder extends Seeder {

    private $threads;
    private $replies;
    private $userIds;
    private $time;

    public function __construct() {
        $this->threads = Thread::with('likes')->get();
        $this->replies = Reply::with('likes')->get();
        $this->userIds = User::where('type', User::MEMBER)->pluck('id')->toArray();
        $this->time = Carbon::now();
    }

    public function run() {
        $this->createFalseLikes($this->threads);
        $this->createFalseLikes($this->replies);
    }

    private function createFalseLikes($falsibles) {
        $falseLikes = [];

        foreach ($falsibles as $falsible) {
            $numLikes = $falsible->likes->count();
            $randKeys = array_rand($this->userIds, $numLikes);

            for ($i = 0; $i < $numLikes; $i++) {
                $like = $falsible->likes[$i];

                $falseLikes[] = [
                    'falsible_id' => $like->likable_id,
                    'falsible_type' => $like->likable_type,
                    'user_id' => $this->userIds[$randKeys[$i]],
                    'created_at' => $this->time,
                    'updated_at' => $this->time
                ];
            }
        }

        DB::table('falsible_falselikes')->insert($falseLikes);
    }
}