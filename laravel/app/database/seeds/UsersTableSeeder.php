<?php

class UsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->truncate();
        DB::table('user_profiles')->truncate();

        $mark = GSVnet\Users\User::create(array(
            'email'         => 'markredeman@gmail.com',
            'password'      => 'helloworld',
            'firstname'     => 'Mark',
            'lastname'      => 'Redeman',
            'middlename'    => 'Sietse',
            'username'      => 'mredeman',
            'type'          => 2
        ));

        $count = 200;

        $faker = Faker\Factory::create('en_US');

        $faker->addProvider(new Faker\Provider\en_US\Person($faker));
        $faker->addProvider(new Faker\Provider\en_US\Address($faker));
        $faker->addProvider(new Faker\Provider\Internet($faker));

        $this->command->info('Inserting '.$count.' sample records using Faker ...');

        $yearGroupIds = DB::table('year_groups')->lists('id');

        for( $x=0 ; $x<$count; $x++ )
        {
            $user = GSVnet\Users\User::create(array(
                'firstname' => $faker->firstName,
                'middlename' => 'van',
                'lastname' => $faker->lastName,
                'username' => $faker->userName,
                'password' => 'testen',
                'email' => $faker->companyEmail,
                'type' => rand(0,3)
            ));

            $k = array_rand($yearGroupIds);

            GSVnet\Users\UserProfile::create(array(
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
                'gender' => 'male',
                'start_date_rug' => $faker->dateTimeThisCentury->format('Y-m-d'),
                'reunist' => rand(0,1),
                'parent_address' => $faker->streetAddress,
                'parent_zip_code' => $faker->postcode,
                'parent_town' => $faker->city,
                'parent_phone' => $faker->phoneNumber
            ));
        }

        GSVnet\Users\UserProfile::create(array(
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
            'gender' => 'male',
            'start_date_rug' => '2011-08-01',
            'reunist' => 0,
            'parent_address' => 'Mooiestraat 3',
            'parent_zip_code' => '9556EX',
            'parent_town' => 'Opende',
            'parent_phone' => '0800-223344'
        ));

        $this->command->info('Person table seeded using Faker ...');
    }
}
