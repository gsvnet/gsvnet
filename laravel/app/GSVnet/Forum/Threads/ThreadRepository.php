<?php namespace GSVnet\Forum\Threads;

use Illuminate\Support\Collection;
use GSVnet\Core\Exceptions\EntityNotFoundException;

use Permission;
use Auth;
use GSVnet\Permissions\NoPermissionException;

class ThreadRepository extends \GSVnet\Core\EloquentRepository
{
    public function __construct(Thread $model)
    {
        $this->model = $model;
    }

    public function getByTagsPaginated(Collection $tags, $perPage = 20)
    {
        $query = $this->model->with(['mostRecentReply', 'mostRecentReply.author', 'tags']);

        if ($tags->count() > 0) {
            $query->join('tagged_items', 'forum_threads.id', '=', 'tagged_items.thread_id')
                ->whereIn('tagged_items.tag_id', $tags->lists('id'));
        }

        if ( ! Permission::has('threads.show-private'))
        {
            $query = $query->public();
        }

        if ( Auth::check() )
        {
            $id = Auth::user()->id;
            $query->with(['visitations' => function($q) use ($id)
            {
                $q->where('user_id', $id);
            }]);
        }

        $query->orderBy('updated_at', 'desc');

        return $query->paginate($perPage, ['forum_threads.*']);
    }

    public function getThreadRepliesPaginated(Thread $thread, $perPage = 20)
    {
        return $thread->replies()->with('author')->paginate($perPage);
    }

    public function requireBySlug($slug)
    {
        $model = $this->getBySlug($slug);

        if ( ! $model) {
            throw new EntityNotFoundException;
        }

        return $model;
    }

    public function getBySlug($slug)
    {
        $query = $this->model->where('slug', '=', $slug);
        
        // Include removed ones if permissions allow
        if ( Permission::has('threads.manage'))
        {
            $query = $query->withTrashed();
        }

        return $query->first();
    }

    public function getTrashedPaginated($perPage = 20)
    {
        $query = $this->model->onlyTrashed()->with(['mostRecentReply', 'mostRecentReply.author', 'tags']);

        if ( ! Permission::has('threads.show-private'))
        {
            $query = $query->public();
        }

        if ( Auth::check() )
        {
            $id = Auth::user()->id;
            $query->with(['visitations' => function($q) use ($id)
            {
                $q->where('user_id', $id);
            }]);
        }

        $query->orderBy('updated_at', 'desc');

        return $query->paginate($perPage, ['forum_threads.*']);
    }
}
