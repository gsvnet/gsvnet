<?php

class YearGroupsSeeder extends Seeder {
	public function run() {
		DB::table('year_groups')->truncate();

		Model\YearGroup::create(array(
			'name' => 'Xiudez',
			'year' => '2013'
		));
		Model\YearGroup::create(array(
			'name' => 'Llavontar',
			'year' => '2012'
		));
		Model\YearGroup::create(array(
			'name' => 'Marikstos',
			'year' => '2011'
		));
		Model\YearGroup::create(array(
			'name' => 'Frinchov',
			'year' => '2010'
		));
	}
}