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
            'GSV' => 'GSV-specifieke onderwerpen',
            'Nieuws' => 'alle typen nieuwsberichten',
            'Discussie' => 'voor onderwerpen die een discussie te weeg brengen',
            'Senaat' => 'huidige en oude senaten, vragen aan de senaat',
            
            'Maatschappij en politiek' => 'onderwerpen met betrekking tot maatschappij en politiek',
            'Geloof en wetenchap' => 'onderwerpen met betrekking tot geloof en wetenchap',
            'Vraag en aanbod' => 'voor mensen die een kamer zoeken of aanbieden, en andere dingen',
            
            'Regio' => 'onderwerpen met betrekking tot een der regionen',
            'Jaarverband' => 'onderwerpen met betrekking tot een jaarverband',
        ];

        foreach ($commonTags as $name => $description) {
            Tag::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $description,
                'articles' => 1,
                'forum' => 1,
            ]);
        }
    }
}
