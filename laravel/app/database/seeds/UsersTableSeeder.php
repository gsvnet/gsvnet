<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
        DB::table('users')->truncate();
        DB::table('user_profiles')->truncate();

		Model\User::create(array(
            'email'         => 'markredeman@gmail.com',
            'password'      => Hash::make('helloworld'),
            'firstname'     => 'Mark',
            'lastname'      => 'Redeman',
            'middlename'    => 'Sietse',
            'username'      => 'mredeman',
            'type'          => 3,

        ));

        $count = 20;

        $faker = Faker\Factory::create('en_US');

        $faker->addProvider(new Faker\Provider\en_US\Person($faker));
        $faker->addProvider(new Faker\Provider\en_US\Address($faker));
        $faker->addProvider(new Faker\Provider\Internet($faker));
        
        $this->command->info('Inserting '.$count.' sample records using Faker ...');

        $yearGroupIds = DB::table('year_groups')->lists('id');
        
        for( $x=0 ; $x<$count; $x++ )
        {
            $user = Model\User::create(array(
                'firstname' => $faker->firstName,
                'middlename' => 'van',
                'lastname' => $faker->lastName,
                'username' => $faker->userName,
                'password' => Hash::make('testen'),
                'email' => $faker->companyEmail,
                'type' => rand(1,4)
            ));

            $k = array_rand($yearGroupIds);

            Model\UserProfile::create(array(
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
                'parent_zip_code' => $faker->city,
                'parent_telephone' => $faker->phoneNumber
            ));
        }

        $this->command->info('Person table seeded using Faker ...');
	}

}
