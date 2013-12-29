<?php

class PhotosTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('photos')->truncate();

        $photos = array();

        for ($album_id = 1; $album_id < 4; $album_id++) {

            for ($i = 1; $i < ceil(rand() * 10 + 2); $i++) {
                $photo = array(
                    'name' => 'Photo ' . $i . ' from album ' . $album_id,
                    'album_id' => $album_id,
                    // Let our path be a random lorempixel image
                    'src_path' => 'http://lorempixel.com/634/306/abstract?' . $i,

                    'created_at' => new DateTime('today'),
                    'updated_at' => new DateTime('today')
                );
                $photos[] = $photo;
            }

    		DB::table('photos')->insert($photos);
            $photos = [];
        }

        // Uncomment the below to run the seeder
	}

}
