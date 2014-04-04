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
            
            'Politiek' => 'onderwerpen met betrekking tot politiek',
            'Maatschappij' => 'voor maatschappelijke stages, et cetera',
            'Geloof' => 'onderwerpen met betrekking tot geloof en wetenchap',
            'Wetenschap' => 'onderwerpen met betrekking tot geloof en wetenchap',
            'Vraag' => 'op zoek naar een kamer, gereedschap, een boek, of iets anders',
            'Aanbod' => 'kamer aangeboden of iets anders',
            
            'Regio' => 'onderwerpen met betrekking tot één der regionen',
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
