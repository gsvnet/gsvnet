<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{

		$users = array(
            array(
                'email'         => 'markredeman@gmail.com',
                'password'      => Hash::make('hello world'),
                'firstname'     => 'Mark',
                'lastname'      => 'Redeman',
                'username'      => 'mredeman'

            )
		);
		
		DB::table('users')->insert($users);
	}

}
