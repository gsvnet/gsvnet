<?php

use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder {

    public function run()
    {

        $faker = Faker\Factory::create('en_US');
        $yearGroupIds = DB::table('year_groups')->lists('id');


        $mark = GSVnet\Users\User::create(array(
            'email'         => 'markredeman@gmail.com',
            'password'      => 'helloworld',
            'firstname'     => 'Mark',
            'lastname'      => 'Redeman',
            'middlename'    => 'Sietse',
            'username'      => 'mredeman',
            'type'          => 2,
            'approved'      => true
        ));

        GSVnet\Users\Profiles\UserProfile::create(array(
            'user_id' => $mark->id,
            'year_group_id' => $yearGroupIds[array_rand($yearGroupIds)],
            'region' => rand(1,4),
            'phone' => '050-4040544',
            'address' => 'Mooistraat 2',
            'zip_code' => '9712AX',
            'town' => 'Groningen',
            'study' => 'Technische Wiskunde',
            'birthdate' => '1992-10-10',
            'church' => 'GKV',
            'gender' => 0,
            'student_number' => 's1111111',
            'reunist' => 0,
            'parent_address' => 'Mooiestraat 3',
            'parent_zip_code' => '9556EX',
            'parent_town' => 'Opende',
            'parent_phone' => '0800-223344'
        ));

        $startdate = $faker->dateTimeBetween('-3 years', '-1 month');

        $webcie = GSVnet\Committees\Committee::where('unique_name', '=', 'webcie')->first();
        $mark->committees()->save($webcie, array('start_date' => $startdate));
    }
}
