<?php namespace GSVnet\Forum\Threads;

use GSVnet\Core\Slug;

class ThreadSlug implements Slug {

    private $slug;
    private $threads;

    function __construct(ThreadRepository $threads)
    {
        $this->threads = $threads;
        $this->slug = $this->generateUniqueSlugFrom($slug);
    }

    static function generate($from = null)
    {
        return new static($from);
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function generateUniqueSlugFrom($desired)
    {
        for($i=0; $i<100; ++$i)
        {
            $slug = $this->generateSlugWithIndex($i, $desired);
            if(! $this->slugExists($slug))
                return $slug;
        }

        return str_random(16);
    }

    private function slugExists($slug)
    {
        return $this->model->where('slug', '=', $slug)->exists();
    }

    private function generateSlugWithIndex($i, $desired)
    {
        $appendix = '-' . $i;

        if ($i == 0)
            $appendix = '';

        $date = date('d-m-Y');

        return Str::slug("{$date}-{$desired}"  . $appendix);
    }
}