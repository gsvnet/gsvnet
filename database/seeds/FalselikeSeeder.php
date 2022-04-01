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

    private $userIds;
    private $time;

    public function __construct() {
        $this->userIds = User::where('type', User::MEMBER)->pluck('id')->toArray();
        $this->time = Carbon::now();
    }

    public function run() {
        DB::table('falsible_falselikes')->truncate();

        $this->createFalseLikes(Thread::class);
        $this->createFalseLikes(Reply::class);
    }

    public function createFalseLikes($model) {
        $count = $model::count();
        $bar = $this->command->getOutput()->createProgressBar($count);

        $model::with('likes')->chunk(100, function ($falsibles) use ($bar) {
            $falseLikes = [];

            foreach ($falsibles as $falsible) {
                $bar->advance();

                $numLikes = $falsible->likes->count();

                if ($numLikes > 0)
                    $randKeys = array_rand($this->userIds, $numLikes);

                if ($numLikes == 1)
                    $randKeys = [$randKeys];

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
        });

        $bar->finish();
    }
}