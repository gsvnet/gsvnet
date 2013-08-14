<?php

class EventsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('events')->truncate();

        $events = array();

        for ($i = 0; $i < 20; $i++) {
            $event = array(
                'title' => 'Activiteit ' . $i,
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quicquid opinemur.',

                'start_date' => new DateTime('today +' . $i . 'day'),
                'end_date' => null,

                'created_at' => new DateTime('today'),
                'updated_at' => new DateTime('today')
            );

            $events[] = $event;
        }

		// Uncomment the below to run the seeder
		DB::table('events')->insert($events);
	}

}
