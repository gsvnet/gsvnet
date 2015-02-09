<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('CommitteesTableSeeder');
		$this->call('YearGroupsSeeder');
		$this->call('UsersTableSeeder');
		$this->call('EventsTableSeeder');
		$this->call('UserCommitteeSeeder');
		$this->call('LabelsTableSeeder');
		$this->call('AlbumsTableSeeder');
		$this->call('PhotosTableSeeder');
		$this->call('SenatesTableSeeder');
		$this->call('BetaTestersTableSeeder');
		$this->call('TagSeeder');
		//$this->call('ForumTableSeeder');
	}

}
