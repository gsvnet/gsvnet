<?php

use Carbon\Carbon;
use App\Helpers\Committees\Committee;
use App\Helpers\Users\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserCommitteeSeeder extends Seeder {

    private $userIds;
    private $committeeIds;
    private $faker;

    public function __construct()
    {
        $this->userIds = User::where('type', '=', 2)->lists('id')->all();
        $this->committeeIds = Committee::lists('id')->all();
        $this->time = Carbon::now();
        $this->faker = Faker\Factory::create('nl_NL');
    }

	public function run()
	{
        $memberships = [];

        foreach($this->userIds as $userId)
        {
            // 4 out of 10 are not in a committee
            if($this->faker->numberBetween(1, 10) <= 4)
                continue;

            $total = $this->faker->numberBetween(1, 3);
            $committeeIds = $this->faker->randomElements($this->committeeIds, $total);

            foreach($committeeIds as $committeeId)
            {
                $startDate = $this->faker->dateTimeBetween('-3 years', '-1 month');

                $memberships[] = [
                    'committee_id' => $committeeId,
                    'user_id' => $userId,
                    'start_date' => $startDate->format('Y-m-d'),
                    'end_date' => $startDate->add(date_interval_create_from_date_string('1 year'))->format('Y-m-d'),
                    'created_at' => $this->time,
                    'updated_at' => $this->time,
                ];
            }
        }

        DB::table('committee_user')->insert($memberships);
	}
}
