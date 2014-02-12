<?php

class AlbumsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('albums')->truncate();

        $albums = array();

        // for ($i = 1; $i < 4; $i++) {
        //     Model\Album::create(array(
        //         'name' => 'Album ' . $i,
        //         'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quicquid opinemur.',
        //         'slug' => Str::slug('Album ' . $i),

        //     ));
        // }
	}

}
