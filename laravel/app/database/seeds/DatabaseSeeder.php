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

		$this->call('AlbumsTableSeeder');
		$this->call('CommitteesTableSeeder');
		$this->call('PhotosTableSeeder');
		$this->call('YearGroupsSeeder');
		$this->call('UsersTableSeeder');
		$this->call('EventsTableSeeder');
	}

}