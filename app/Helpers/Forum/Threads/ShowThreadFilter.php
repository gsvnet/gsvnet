<?php

namespace App\Helpers\Forum\Threads;

use App\Helpers\Permissions\NoPermissionException;
use Illuminate\Support\Facades\Gate;

class ShowThreadFilter
{
    protected $threads;

    public function __construct(ThreadRepository $threads)
    {
        $this->threads = $threads;
    }

    public function filter($route)
    {
        $slug = $route->parameter('slug');
        $thread = $this->threads->getBySlug($slug);

        if ($thread->public) {
            return;
        }

        if (! Gate::allows('photos.show-private')) {
            throw new NoPermissionException;
        }
    }
}
