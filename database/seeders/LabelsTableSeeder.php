<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LabelsTableSeeder extends Seeder
{
    public function run(): void
    {
        $labels = [
            [
                'name' => 'Commissies',
            ],
            [
                'name' => 'Notulen',
            ],
            [
                'name' => 'Senaat',
            ],
        ];

        DB::table('labels')->insert($labels);
    }
}
