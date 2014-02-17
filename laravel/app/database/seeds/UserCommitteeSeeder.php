<?php

class UserCommitteeSeeder extends Seeder {

	public function run()
	{
        DB::table('committee_user')->truncate();

        $faker = Faker\Factory::create('en_US');

        $users = GSVnet\Users\User::where('type', '=', 2)->get();
        $committees = DB::table('committees')->lists('id');

        foreach($users as $user)
        {
            // ~20% of the users are not in a committee
            if((float)rand()/(float)getrandmax() < 0.2)
            {
                continue;
            }

            // Shuffle committees
            shuffle($committees);

            // Take a sample of committees
            $number = min(rand(2,10), count($committees));

            for($i=1; $i<$number; $i++)
            {
                $startdate = $faker->dateTimeBetween('-3 years', '-1 month');
                $user->committees()->attach($committees[$i], array(
                    'start_date' => $startdate->format('Y-m-d'),
                    'end_date' => $startdate->add(date_interval_create_from_date_string('5 year'))->format('Y-m-d')
                ));
            }

        }

        $this->command->info('Added some people to committees ...');
	}

}
