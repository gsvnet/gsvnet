<?php

use App\Helpers\Albums\Album;
use Illuminate\Database\Seeder;

class AlbumsTableSeeder extends Seeder
{
    public function run()
    {
        Album::create([
            'name' => 'Honden',
            'description' => 'Foto\'s van honden.',
            'slug' => '1-honden',
            'public' => false,
        ]);

        Album::create([
            'name' => 'Katten',
            'description' => 'Foto\'s van katten.',
            'slug' => '2-katten',
            'public' => true,
        ]);
    }
}
