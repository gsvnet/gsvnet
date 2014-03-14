<?php namespace GSVnet\Forum\Threads;

use Illuminate\Support\Collection;
use GSVnet\Core\Exceptions\EntityNotFoundException;

use Permission;
use GSVnet\Permissions\NoPermissionException;

class ThreadRepository extends \GSVnet\Core\EloquentRepository
{
    public function __construct(Thread $model)
    {
        $this->model = $model;
    }

    public function getByTagsPaginated(Collection $tags, $perPage = 20)
    {
        $query = $this->model->with(['mostRecentReply', 'tags']);

        if ($tags->count() > 0) {
            $query->join('tagged_items', 'forum_threads.id', '=', 'tagged_items.thread_id')
                ->whereIn('tagged_items.tag_id', $tags->lists('id'));
        }

        if ( ! Permission::has('threads.show-private'))
        {
            $query = $query->public();
        }

        $query->groupBy('forum_threads.id')
            ->orderBy('updated_at', 'desc');

        return $query->paginate($perPage, ['forum_threads.*']);
    }

    public function getThreadRepliesPaginated(Thread $thread, $perPage = 20)
    {
        return $thread->replies()->paginate(20);
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
        return $this->model->where('slug', '=', $slug)->first();
    }
}
