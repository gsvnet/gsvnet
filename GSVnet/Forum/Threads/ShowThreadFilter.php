<?php namespace GSVnet\Forum\Threads;

use GSVnet\Permissions\NoPermissionException;
use Illuminate\Support\Facades\Gate;

class ShowThreadFilter
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

        if ( ! Gate::allows('photos.show-private'))
            throw new NoPermissionException;
    }
}
