<?php

class SenatesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('senates')->truncate();

		$senates = [
			['name' => 'Van de Kamp', 'start_date' => '2013-09-14', 'end_date' => '2014-09-14', 'body' => 'test'],
			['name' => 'Winters', 'start_date' => '2012-09-14', 'end_date' => '2013-09-14', 'body' => 'test'],
			['name' => 'Molenaar', 'start_date' => '2011-09-14', 'end_date' => '2012-09-14', 'body' => 'test'],
		];

		DB::table('senates')->insert($senates);

		// Add some users
		$users = GSVnet\Users\User::take(15)->get();
		$functions = ['praeses', 'assessor primus', 'assessor secundus', 'abactis', 'fiscus'];
		$i=0;
		foreach($users as $user)
		{
			$user->senates()->attach(floor(($i+1)/5), array('function' => $functions[$i%5]));
			$i++;
		}
	}

}
