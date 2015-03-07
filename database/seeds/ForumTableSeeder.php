<?php

use Carbon\Carbon;
use Faker\Factory;
use GSVnet\Forum\Threads\Thread;
use GSVnet\Tags\Tag;
use GSVnet\Users\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ForumTableSeeder extends Seeder {

    private $time;
    private $faker;
    private $userIds;
    private $numThreads = 30;
    private $maxReplies = 50;

    function __construct()
    {
        $this->faker = Factory::create('nl_NL');
        $this->time = Carbon::now();
        $this->userIds = User::lists('id');
        $this->tagIds = Tag::lists('id');
    }

    public function run()
    {
        $this->command->info('Bezig ' . $this->numThreads . ' topics toe te voegen met maximaal ' . $this->maxReplies . ' reacties');

        $threads = $this->generateThreads();

        $replyId = 0;
        $replies = [];
        $tags = [];

        foreach ($threads as $id => $thread)
        {
            $replyId++;
            $tagIds = $this->faker->randomElements($this->tagIds, 2);

            $lastReply = $this->generateReply($id+1, $thread['created_at'], 'now');
            $replies[] = $lastReply;

            $threads[$id]['most_recent_reply_id'] = $replyId;
            $threads[$id]['updated_at'] = $lastReply['created_at'];

            for ($i = 1; $i < $thread['reply_count']; $i++, $replyId++)
            {
                $replies[] = $this->generateReply($id+1, $thread['created_at'], $lastReply['created_at']);
            }

            foreach ($tagIds as $tagId)
            {
                $tags[] = $this->generateTag($id+1, $tagId);
            }
        }

        DB::table('forum_threads')->insert($threads);
        DB::table('forum_replies')->insert($replies);
        DB::table('tagged_items')->insert($tags);
    }

    private function generateThreads()
    {
        $threads = [];
        $date = $this->faker->dateTimeThisYear();

        for($j = 0; $j < $this->numThreads; $j++)
        {
            $subject = $this->faker->text(20);

            $threads[] = [
                'subject' => $this->faker->text(20),
                'body' => $this->faker->paragraphs(rand(1, 5), true),
                'slug' => Str::slug($subject . '-' . str_random(4)),
                'public' => $this->faker->boolean(70),
                'author_id' => $this->faker->randomElement($this->userIds),
                'created_at' => $date,
                'updated_at' => $date,
                'like_count' => 0,
                'reply_count' => rand(0, $this->maxReplies)
            ];
        }

        return $threads;
    }

    private function generateReply($id, $from, $to)
    {
        $replied_on = $this->faker->dateTimeBetween($from, $to);
        
        return [
            'body' => $this->faker->paragraphs(rand(1, 5), true),
            'thread_id' => $id,
            'author_id' => $this->faker->randomElement($this->userIds),
            'created_at' => $replied_on,
            'updated_at' => $replied_on,
            'like_count' => 0
        ];
    }

    private function generateTag($threadId, $tagId)
    {
        return [
            'thread_id' => $threadId,
            'tag_id' => $tagId,
            'created_at' => $this->time,
            'updated_at' => $this->time
        ];
    }
}