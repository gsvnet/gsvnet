<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->truncate();
        DB::table('user_profiles')->truncate();

        $count = 50;

        $faker = Faker\Factory::create();
        $faker->addProvider(new Faker\Provider\en_US\Person($faker));
        $faker->addProvider(new Faker\Provider\en_US\Address($faker));
        $faker->addProvider(new Faker\Provider\Internet($faker));
        $faker->addProvider(new Faker\Provider\Miscellaneous($faker));

        $this->command->info('Bezig '.$count.' users toe te voegen');

        $yearGroupIds = DB::table('year_groups')->lists('id');

        for( $x=0 ; $x<$count; $x++ )
        {
            $type = rand(0,3);

            $user = GSVnet\Users\User::create(array(
                'firstname' => $faker->firstName,
                'middlename' => 'van',
                'lastname' => $faker->lastName,
                'username' => $faker->userName,
                'password' => 'testen',
                'email' => $faker->companyEmail,
                'type' => rand(0,3),
                // make the user approved 90% of the time
                'approved' => $faker->boolean(90)
            ));

            if($type == 2 || $type == 3)
            {

                $k = array_rand($yearGroupIds);

                GSVnet\Users\Profiles\UserProfile::create(array(
                    'user_id' => $user->id,
                    'year_group_id' => $yearGroupIds[$k],
                    'region' => rand(1,4),
                    'phone' => $faker->phoneNumber,
                    'address' => $faker->streetAddress,
                    'zip_code' => $faker->postcode,
                    'town' => $faker->city,
                    'study' => 'Technische Wiskunde',
                    'birthdate' => $faker->dateTimeThisCentury->format('Y-m-d'),
                    'church' => 'GKV',
                    'gender' => 0,
                    'student_number' => 's' . (string) rand(1000000, 3000000),
                    'reunist' => rand(0,1),
                    'parent_address' => $faker->streetAddress,
                    'parent_zip_code' => $faker->postcode,
                    'parent_town' => $faker->city,
                    'parent_phone' => $faker->phoneNumber
                ));

            }
        }

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
            'student_number' => 's2151934',
            'reunist' => 0,
            'parent_address' => 'Mooiestraat 3',
            'parent_zip_code' => '9556EX',
            'parent_town' => 'Opende',
            'parent_phone' => '0800-223344'
        ));

        $this->command->info('Person table seeded using Faker ...');
    }
}
