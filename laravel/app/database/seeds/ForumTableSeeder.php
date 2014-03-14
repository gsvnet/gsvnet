<?php

class ForumTableSeeder extends Seeder implements
    GSVnet\Forum\Threads\ThreadCreatorListener,
    GSVnet\Forum\Replies\ReplyCreatorListener {

    public function run()
    {
        DB::table('forum_threads')->truncate();
        DB::table('forum_replies')->truncate();
        DB::table('tagged_items')->truncate();

        $faker = Faker\Factory::create();
        $users = GSVnet\Users\User::all(); //orderBy(DB::raw('RAND()'))->get();
        $numThreads = 30;
        $maxReplies = 300;

        $this->command->info('Bezig '.$numThreads.' topics toe te voegen met maximaal ' . $maxReplies . ' replies');

        for($j=0; $j<$numThreads; $j++)
        {
        	$tags = GSVnet\Tags\Tag::orderBy(DB::raw('RAND()'))->take(rand(1,3))->get();
	        $thread = App::make('GSVnet\Forum\Threads\ThreadCreator')->create($this, [
	            'subject' => $faker->text(20),
	            'body' => $this->randomBody($faker),
	            'author' => $faker->randomElement($users),
	            'tags' => $tags,
                'public' => $faker->boolean(70)
	        ]);

            // Willekeurige users geven willekeurige reacties
            for ($i=0; $i < rand(0, $maxReplies); $i++) {
                App::make('GSVnet\Forum\Replies\ReplyCreator')->create($this, [
                    'body' => $this->randomBody($faker),
                    'author' => $faker->randomElement($users),
                ], $thread->id);
            }

            // Show progress message
            if ($j % 10 == 0)
                $this->command->info(($j + 1) . " / $numThreads  threads toegevoegd");
        }
    }

    // Gewoon even wat functies
    public function threadCreationError($errors)
    {
    	dd($errors);
    }

    public function threadCreated($thread)
    {
    	return $thread;
    }

    // Gewoon even wat functies
    public function replyCreationError($errors)
    {
        dd($errors);
    }

    public function replyCreated($reply)
    {
        return $reply;
    }

    private function randomBody($faker)
    {
        return $faker->paragraphs(rand(1, 5), true);
    }
}