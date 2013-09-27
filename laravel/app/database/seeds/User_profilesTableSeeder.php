<?php

class User_profilesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('user_profiles')->truncate();

		$user_profiles = [
			[
				'firstname' => 'Mark',
				'lastname' => 'Stoppels'
			]
		];

		// Uncomment the below to run the seeder
		DB::table('user_profiles')->insert($user_profiles);
	}

}
