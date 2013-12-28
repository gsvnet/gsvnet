<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{

		$users = array(
            array(
                'email'         => 'markredeman@gmail.com',
                'password'      => Hash::make('helloworld'),
                'firstname'     => 'Mark',
                'lastname'      => 'Redeman',
                'middlename'    => 'Sietse',
                'username'      => 'mredeman',

                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),

            )
		);

		DB::table('users')->insert($users);
	}

}
