<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EventsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create('nl_NL');
        $events = [];
        $now = Carbon::now();

        for ($i = 0; $i < 200; $i++) {
            $randHour = rand(0, 22);
            $startDate = $faker->dateTimeBetween('-1 year', '+1 month');

            $activities = ['Schaatsen', 'Bijbelkring', 'Voetballen', 'Lezing', 'Soos', 'Je moeder', 'Volleyballen', 'Huishoudelijke vergadering', 'Regiokamp'];
            $places = ['Soos', 'Het Heerenhuis', '', '', '', 'Vinkhuizen', 'Oosterkerk'];

            $title = $faker->randomElement($activities);

            $events[] = [
                'title' => $title,
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quicquid opinemur.',
                'meta_description' => 'Hier komt een beschrijving van '.$title,
                'slug' => Str::slug($title).'-'.str_random(4),
                'location' => $faker->randomElement($places),
                'whole_day' => rand(0, 1),
                'type' => rand(0, 3),
                'public' => rand(1, 10) > 3,
                'start_time' => $randHour.':'.rand(0, 59),
                'start_date' => $startDate->format('Y-m-d'),
                'end_date' => $startDate->add(date_interval_create_from_date_string(rand(0, 2).' days'))->format('Y-m-d'),
                'published' => rand(1, 10) > 3,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('events')->insert($events);
    }
}
