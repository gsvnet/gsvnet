<?php

class PhotosTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('photos')->truncate();

        for ($album_id = 1; $album_id < 4; $album_id++) {

            for ($i = 1; $i < ceil(rand(1,2) * 10 + 2); $i++) {
                Model\Photo::create(array(
                    'name' => 'Photo ' . $i . ' from album ' . $album_id,
                    'album_id' => $album_id,
                    'src_path' => 'http://lorempixel.com/634/306/abstract?' . $i
                ));
            }
        }

        // Uncomment the below to run the seeder
	}

}
