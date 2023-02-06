<?php

namespace App\Helpers\Emoticons;

class Emoticon
{
    private static $dir = '/images/emoticons/';

    private static $emoticons = [
        ':grote-lach:' => 'grote-lach.gif',
        ':buiging:' => 'buiging.gif',
        ':schaterlach:' => 'schaterlach.gif',
        ':awesome:' => 'welw.gif',
        ':slijmbal:' => 'slijmbal.gif',
        ':degrooteprimus:' => 'grooteprimus.gif',
        ':degrootepenis:' => 'grooteprimus.gif',
    ];

    private $replacements = [];

    public function __construct()
    {
        array_walk(self::$emoticons, ['self', 'initializeReplacements']);
    }

    public function toHTML($input)
    {
        return str_replace(array_keys(self::$emoticons), $this->replacements, $input);
    }

    private function initializeReplacements($image, $name)
    {
        $this->replacements[] = '<img src="'.self::$dir.$image.'" class="emo" alt="'.$name.'" title="'.$name.'" />';
    }
}
