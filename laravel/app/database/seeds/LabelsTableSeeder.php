<?php

class LabelsTableSeeder extends Seeder {
    public function run() {
        DB::table('labels')->truncate();

        Model\Label::create([
            'name' => 'Commissies'
        ]);
        Model\Label::create([
            'name' => 'Notulen'
        ]);
        Model\Label::create([
            'name' => 'Senaat'
        ]);
    }
}