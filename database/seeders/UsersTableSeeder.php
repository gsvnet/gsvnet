<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    private $groupIds;

    private $totalUsers = 2000;

    private $faker;

    private $studies = ['Wiskunde', 'Geschiedenis', 'Tandheelkunde', 'IB/IO', 'Bedrijfskunde'];

    private $time;

    public function __construct()
    {
        $this->groupIds = DB::table('year_groups')->pluck('id');
        $this->faker = Faker\Factory::create('nl_NL');
        $this->time = Carbon::now();
    }

    public function run()
    {
        $users = [];
        $profiles = [];
        $password = bcrypt('testen');

        foreach (range(1, $this->totalUsers) as $userId) {
            $type = rand(0, 3);

            $users[] = [
                'firstname' => $this->faker->firstName,
                'middlename' => '',
                'lastname' => $this->faker->lastName,
                'username' => $this->faker->userName,
                'password' => $password,
                'email' => $this->faker->companyEmail,
                'verified' => $this->faker->boolean(30),
                'type' => $type,
                'approved' => true,
                'created_at' => $this->time,
                'updated_at' => $this->time,
            ];

            if ($type == 2 || $type == 3) {
                $group = $this->faker->randomElement($this->groupIds);

                $profiles[] = [
                    'user_id' => $userId,
                    'year_group_id' => $group,
                    'phone' => $this->faker->phoneNumber,
                    'address' => $this->faker->streetAddress,
                    'zip_code' => $this->faker->postcode,
                    'town' => $this->faker->city,
                    'study' => $this->faker->randomElement($this->studies),
                    'birthdate' => $this->faker->dateTimeThisCentury->format('Y-m-d'),
                    'gender' => rand(0, 1),
                    'student_number' => 's'.(string) rand(1000000, 3000000),
                    'reunist' => $type == 3 ? rand(0, 1) : 0,
                    'parent_address' => $this->faker->streetAddress,
                    'parent_zip_code' => $this->faker->postcode,
                    'parent_town' => $this->faker->city,
                    'parent_phone' => $this->faker->phoneNumber,
                    'created_at' => $this->time,
                    'updated_at' => $this->time,
                ];
            }
        }

        DB::table('users')->insert($users);
        DB::table('user_profiles')->insert($profiles);
    }
}
