<?php namespace GSVnet\Forum\Threads;

use GSVnet\Forum\Threads\ThreadRepository;
use Permission;

Class ShowThreadFilter
{
    protected $threads;

    public function __construct(ThreadRepository $threads)
    {
        $this->threads  = $threads;
    }

    public function filter($route)
    {
        $slug = $route->getParameter('slug');
        $thread = $this->threads->getBySlug($slug);

        if ($thread->public)
            return;

        if ( ! Permission::has('photos.show-private'))
            throw new \GSVnet\Permissions\NoPermissionException;
    }
}