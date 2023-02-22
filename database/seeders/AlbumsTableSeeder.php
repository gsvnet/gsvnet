<?php

namespace Database\Seeders;

use App\Helpers\Albums\Album;
use Illuminate\Database\Seeder;
use Faker;

class AlbumsTableSeeder extends Seeder
{
    public function run(): void
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
