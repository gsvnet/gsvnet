<?php

class RandomUsersTableSeeder extends Seeder {

	public function run()
	{
    	$count = 75;

    	$faker = Faker\Factory::create('en_GB');

    	$faker->addProvider(new Faker\Provider\en_GB\Address($faker));
    	$faker->addProvider(new Faker\Provider\en_GB\Internet($faker));

        $this->command->info('Inserting '.$count.' sample records using Faker ...');

        for( $x=0 ; $x<$count; $x++ )
    	{
    		Model\User::create(array(
    			'firstname' => $faker->firstName,
    			'lastname' => $faker->lastName,
    			'email' => $faker->email,
    			'password' => Hash::make('test')
    		));
    	}
	}

}
