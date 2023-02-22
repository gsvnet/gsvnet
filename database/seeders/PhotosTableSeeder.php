<?php

namespace Database\Seeders;

use App\Helpers\Albums\Photos\Photo;
use Illuminate\Database\Seeder;
use Faker;

class PhotosTableSeeder extends Seeder
{
    public function run(): void
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
