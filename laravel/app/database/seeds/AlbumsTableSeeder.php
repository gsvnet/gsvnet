<?php

use GSVnet\Albums\Album;

class AlbumsTableSeeder extends Seeder {

	public function run()
	{
    	// Uncomment the below to wipe the table clean before populating
    	DB::table('albums')->truncate();

        Album::create([
            'name' => 'Honden',
            'description' => 'Foto\'s van honden.',
            'slug' => '1-honden',
            'public' => false
        ]);

        Album::create([
            'name' => 'Katten',
            'description' => 'Foto\'s van katten.',
            'slug' => '2-katten',
            'public' => true
        ]);
	}
}
