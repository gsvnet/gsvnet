<?php
use GSVnet\Files\Labels\Label;

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