<?php

class YearGroupsSeeder extends Seeder {
	public function run() {
		DB::table('year_groups')->truncate();

		GSVnet\Users\YearGroup::create(array(
			'name' => 'Xiudez',
			'year' => '2013'
		));
		GSVnet\Users\YearGroup::create(array(
			'name' => 'Llavontar',
			'year' => '2012'
		));
		GSVnet\Users\YearGroup::create(array(
			'name' => 'Marikstos',
			'year' => '2011'
		));
		GSVnet\Users\YearGroup::create(array(
			'name' => 'Frinchov',
			'year' => '2010'
		));
	}
}