<?php

namespace App\Helpers\Forum\Threads;

use App\Helpers\Core\Slug;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class ThreadSlug implements Slug
{
    private $threads;

    private $tries = 5;

    public function __construct(ThreadRepository $threads)
    {
        $this->threads = $threads;
    }

    public function generateSlug($from)
    {
        for ($i = 0; $i < $this->tries; $i++) {
            $slug = $this->generateSlugWithIndex($i, $from);
            if (! $this->threads->slugExists($slug)) {
                return $slug;
            }
        }

        return str_random(16);
    }

    private function generateSlugWithIndex($i, $desired)
    {
        $appendix = '-'.$i;

        if ($i == 0) {
            $appendix = '';
        }

        $date = date('d-m-Y');

        return Str::slug("{$date}-{$desired}".$appendix);
    }

    public static function generate($from = null)
    {
        $object = App::make(static::class);

        return $object->generateSlug($from);
    }
}
