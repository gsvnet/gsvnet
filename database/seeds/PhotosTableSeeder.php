<?php

use App\Helpers\Albums\Photos\Photo;
use Illuminate\Database\Seeder;

class PhotosTableSeeder extends Seeder
{
    public function run()
    {
        Photo::create([
            'name' => 'Kat',
            'album_id' => 2,
            'src_path' => '/seeds/cat.jpg',
        ]);

        Photo::create([
            'name' => 'Hond',
            'album_id' => 1,
            'src_path' => '/seeds/dog.jpg',
        ]);
    }
}
