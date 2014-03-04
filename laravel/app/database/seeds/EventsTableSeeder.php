<?php

class EventsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('events')->truncate();

        $faker = Faker\Factory::create('en_US');

        for ($i = 0; $i < 20; $i++) {
            $randHour = rand(0, 22);
            $startdate = $faker->dateTimeBetween('now', '+1 year');

            GSVnet\Events\Event::create(array(
                'title' => 'Activiteit ' . $i,
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quicquid opinemur.',
                'location' => '',
                'type' => rand(0, 3),
                'whole_day' => rand(0,1),
                'start_time' => $randHour . ':' . rand(0, 59),
                'start_date' => $startdate->format('Y-m-d'),
                'end_date' => $startdate->add(date_interval_create_from_date_string(rand(0,2) . ' days'))->format('Y-m-d'),
                'published' => rand(1,10) > 3,
                'public' => rand(1,10) > 3
            ));
        }
	}

}
