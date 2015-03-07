<?php

use Carbon\Carbon;
use GSVnet\Senates\Senate;
use GSVnet\Users\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SenatesTableSeeder extends Seeder {

    private $time;

    public function __construct()
    {
        $this->time = Carbon::now();
    }

	public function run()
	{
		$senates = [
			['name' => 'Van de Kamp', 'start_date' => '2013-09-14', 'end_date' => '2014-09-14', 'body' => 'test'],
			['name' => 'Winters', 'start_date' => '2012-09-14', 'end_date' => '2013-09-14', 'body' => 'test'],
			['name' => 'Molenaar', 'start_date' => '2011-09-14', 'end_date' => '2012-09-14', 'body' => 'test'],
		];

		DB::table('senates')->insert($senates);

		// Add some users
		$senateIds = Senate::lists('id');
		$number = count($senateIds);
		$userIds = User::take($number*5)->lists('id');
        $memberships = [];
		$i=0;

		foreach($userIds as $userId)
		{
            $senateIndex = floor($i/5);
            $function = 1 + ($i % 5);

            $memberships[] = [
                'user_id' => $userId,
                'senate_id' => $senateIds[$senateIndex],
				'function' => $function,
                'created_at' => $this->time,
                'updated_at' => $this->time
            ];

			$i++;
		}

        DB::table('user_senate')->insert($memberships);
	}
}
