<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('users')->truncate();

		$users = array(
            array(
                'email'         => 'markredeman@gmail.com',
                'password'      => Hash::make('hello world'),
                'firstname'     => 'Mark',
                'lastname'      => 'Redeman',

                'rug_number'    => 'S2218356'

            )
		);

		// Uncomment the below to run the seeder
		DB::table('users')->insert($users);
	}

}
