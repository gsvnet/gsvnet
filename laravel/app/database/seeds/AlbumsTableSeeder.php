<?php

class AlbumsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('albums')->truncate();

        $albums = array();

        for ($i = 1; $i < 31; $i++) {
            $album = array(
                'name' => 'Album ' . $i,
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quicquid opinemur.',

                'created_at' => new DateTime('today'),
                'updated_at' => new DateTime('today')
            );
            $albums[] = $album;
        }

		// Uncomment the below to run the seeder
		DB::table('albums')->insert($albums);
	}

}
