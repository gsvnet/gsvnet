<?php

use Model\Album, Model\Photo;

class PhotosTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('photos')->truncate();

        $privateAlbum = Album::whereSlug('1-feest')->first();
        $publicAlbum = Album::whereSlug('2-publiek')->first();

        Photo::create([
            'name' => 'Kat',
            'album_id' => 2,
            'src_path' => '/seeds/cat.jpg'
        ]);

        Photo::create([
            'name' => 'Hond',
            'album_id' => 1,
            'src_path' => '/seeds/dog.jpg'
        ]);
	}
}