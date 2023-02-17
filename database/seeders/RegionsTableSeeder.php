<?php

namespace Database\Seeders;

use App\Helpers\Users\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionsTableSeeder extends Seeder
{
    private $faker;

    private $userIds;

    private $regionCount;

    public function __construct()
    {
        $this->faker = Factory::create('nl_NL');
        $this->userIds = User::whereIn('type', [2, 3])->pluck('id')->all();
    }

    public function run(): void
    {
        $this->addRegions();
        $this->assignRegions();
    }

    private function addRegions()
    {
        $regions = [
            [
                'name' => 'Noord',
                'start_date' => '2018-05-29',
                'end_date' => null,
            ], [
                'name' => 'Oost',
                'start_date' => '2018-05-29',
                'end_date' => null,
            ], [
                'name' => 'Zuid',
                'start_date' => '2018-05-29',
                'end_date' => null,
            ], [
                'name' => 'West',
                'start_date' => '2018-05-29',
                'end_date' => null,
            ], [
                'name' => '1',
                'start_date' => '2011-08-01',
                'end_date' => '2018-05-29',
            ], [
                'name' => '2',
                'start_date' => '2011-08-01',
                'end_date' => '2018-05-29',
            ], [
                'name' => '3',
                'start_date' => '2011-08-01',
                'end_date' => '2018-05-29',
            ], [
                'name' => '4',
                'start_date' => '2011-08-01',
                'end_date' => '2018-05-29',
            ], [
                'name' => 'Rood',
                'start_date' => '2005-08-01',
                'end_date' => '2011-08-01',
            ], [
                'name' => 'Oranje',
                'start_date' => '2005-08-01',
                'end_date' => '2011-08-01',
            ], [
                'name' => 'Geel',
                'start_date' => '2005-08-01',
                'end_date' => '2011-08-01',
            ], [
                'name' => 'Groen',
                'start_date' => '2005-08-01',
                'end_date' => '2011-08-01',
            ], [
                'name' => 'Blauw',
                'start_date' => '2005-08-01',
                'end_date' => '2011-08-01',
            ], [
                'name' => 'Paars',
                'start_date' => '2005-08-01',
                'end_date' => '2011-08-01',
            ], [
                'name' => 'A',
                'start_date' => '2000-08-01',
                'end_date' => '2005-08-01',
            ], [
                'name' => 'B',
                'start_date' => '2000-08-01',
                'end_date' => '2005-08-01',
            ], [
                'name' => 'C',
                'start_date' => '2000-08-01',
                'end_date' => '2005-08-01',
            ], [
                'name' => 'D',
                'start_date' => '2000-08-01',
                'end_date' => '2005-08-01',
            ],
        ];
        $this->regionCount = count($regions);
        DB::table('regions')->insert($regions);
    }

    private function assignRegions()
    {
        foreach ($this->userIds as $userId) {
            $user = User::find($userId);
            $region = rand(1, $this->regionCount);

            $user->profile->regions()->attach($region);
        }
    }
}
