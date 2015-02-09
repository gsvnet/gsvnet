<?php

use GSVnet\Files\Labels\Label;
use Illuminate\Database\Seeder;

class LabelsTableSeeder extends Seeder {
    public function run() {
        DB::table('labels')->truncate();

        Label::create([
            'name' => 'Commissies'
        ]);
        Label::create([
            'name' => 'Notulen'
        ]);
        Label::create([
            'name' => 'Senaat'
        ]);
    }
}