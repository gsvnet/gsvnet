<?php

namespace Database\Seeders;

use App\Helpers\Committees\Committee;
use App\Helpers\Users\Profiles\UserProfile;
use App\Helpers\Users\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker\Factory::create('en_US');
        $yearGroupIds = DB::table('year_groups')->pluck('id');
        $regionIds = DB::table('regions')->pluck('id');
        $region = rand(0,3);

        $harmen = User::create([
            'email' => 'lassche.hj@gmail.com',
            'password' => bcrypt('helloworld'),
            'firstname' => 'Harmen',
            'lastname' => 'Stoppels',
            'middlename' => '',
            'username' => 'stabbles',
            'type' => 2,
            'approved' => true,
        ]);

        $profile = UserProfile::create([
            'user_id' => $harmen->id,
            'year_group_id' => $faker->randomElement($yearGroupIds),
            'phone' => '050-4040544',
            'address' => 'Mooistraat 2',
            'zip_code' => '9712AX',
            'town' => 'Groningen',
            'study' => 'Technische Wiskunde',
            'birthdate' => '1992-10-10',
            'gender' => 0,
            'student_number' => 's1111111',
            'reunist' => 0,
            'parent_address' => 'Mooiestraat 3',
            'parent_zip_code' => '9556EX',
            'parent_town' => 'Opende',
            'parent_phone' => '0800-223344',
            'photo_path' => '',
            'region' => $region,
            'initials' => '',
            'company' => '',
            'profession' => '',
            'business_url' => '',
            'country' => '',
            'parent_email' => ''
        ]);

        $startDate = $faker->dateTimeBetween('-3 years', '-1 month');

        $webcie = Committee::where('unique_name', '=', 'webcie')->first();
        $harmen->committees()->save($webcie, ['start_date' => $startDate]);
    }
}
