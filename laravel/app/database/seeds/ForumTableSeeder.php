<?php

class ForumTableSeeder extends Seeder implements GSVnet\Forum\Threads\ThreadCreatorListener {

    public function run()
    {
        DB::table('forum_threads')->truncate();

        $faker = Faker\Factory::create();
        //$faker->addProvider(new Faker\Provider\Text($faker));

        $users = GSVnet\Users\User::orderBy(DB::raw('RAND()'))->take(5)->get();

        foreach($users as $user)
        {
        	$tags = GSVnet\Tags\Tag::orderBy(DB::raw('RAND()'))->take(rand(1,3))->get();
	        App::make('GSVnet\Forum\Threads\ThreadCreator')->create($this, [
	            'subject' => $faker->text(20),
	            'body' => $faker->text(500),
	            'author' => $user,
	            'tags' => $tags
	        ]);
        	
        }
    }

    // Gewoon even wat functies
    public function threadCreationError($errors)
    {
    	dd($errors);
    }

    public function threadCreated($thread)
    {
    	//dd($thread);
    }

}