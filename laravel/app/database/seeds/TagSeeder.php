<?php

use GSVnet\Tags\Tag;

class TagSeeder extends Seeder
{
    public function run()
    {
        DB::table('tags')->truncate();
        $this->createTags();
    }

    private function createTags()
    {
        $commonTags = [
            'Discussie' => 'voor onderwerpen die een discussie te weeg brengen',
            'GSV' => 'GSV-specifieke onderwerpen',
            'Regio' => 'onderwerpen met betrekking tot een der regionen',
            'Jaarverband' => 'onderwerpen met betrekking tot een jaarverband',
            'Maatschappij en politiek' => 'onderwerpen met betrekking tot maatschappij en politiek',
            'Geloof en wetenchap' => 'onderwerpen met betrekking tot geloof en wetenchap',
            'Senaat' => 'huidige senaten, oude senaten',
            'Vraag en aanbod' => 'voor mensen die een kamer zoeken of aanbieden, en andere dingen',
            'Nieuws' => 'alle typen nieuwsberichten'
        ];

        foreach ($commonTags as $name => $description) {
            Tag::create([
                'name' => $name,
                'slug' => $name,
                'description' => $description,
                'articles' => 1,
                'forum' => 1,
            ]);
        }
    }
}
