<?php

use App\Helpers\Files\Labels\Label;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LabelsTableSeeder extends Seeder {
    public function run() {
        $labels = [
            [
                'name' => 'Commissies'
            ],
            [
                'name' => 'Notulen'
            ],
            [
                'name' => 'Senaat'
            ]
        ];

        DB::table('labels')->insert($labels);
    }
}