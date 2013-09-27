<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('MembersTableSeeder');
		$this->call('EventsTableSeeder');
		$this->call('AlbumsTableSeeder');
		$this->call('PhotosTableSeeder');
		$this->call('CommitteesTableSeeder');
		$this->call('UserProfilesTableSeeder');
	}

}