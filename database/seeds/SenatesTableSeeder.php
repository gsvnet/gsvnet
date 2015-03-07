<?php

use GSVnet\Senates\Senate;
use GSVnet\Users\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SenatesTableSeeder extends Seeder {

	public function run()
	{
		$senates = [
			['name' => 'Van de Kamp', 'start_date' => '2013-09-14', 'end_date' => '2014-09-14', 'body' => 'test'],
			['name' => 'Winters', 'start_date' => '2012-09-14', 'end_date' => '2013-09-14', 'body' => 'test'],
			['name' => 'Molenaar', 'start_date' => '2011-09-14', 'end_date' => '2012-09-14', 'body' => 'test'],
		];

		DB::table('senates')->insert($senates);

		// Add some users
		$senates = Senate::all();
		$number = count($senates);
		$users = User::take($number*5)->get();

		$i=0;
		foreach($users as $user)
		{
			$user->senates()->attach(
				$senates[floor($i/5)]->id, 
				['function' => 1 + ($i % 5)]
			);
			$i++;
		}
	}
}
