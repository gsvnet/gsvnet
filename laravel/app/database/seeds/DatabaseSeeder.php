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

		$this->call('CommitteesTableSeeder');
		$this->call('YearGroupsSeeder');
		$this->call('UsersTableSeeder');
		$this->call('EventsTableSeeder');
		$this->call('UserCommitteeSeeder');
		$this->call('LabelsTableSeeder');
		$this->call('AlbumsTableSeeder');
		$this->call('PhotosTableSeeder');
		$this->call('SenatesTableSeeder');
	}

}