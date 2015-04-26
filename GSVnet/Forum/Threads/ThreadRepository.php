<?php namespace GSVnet\Forum\Threads;

use GSVnet\Core\EloquentRepository;
use GSVnet\Forum\Like;
use Illuminate\Support\Collection;
use GSVnet\Core\Exceptions\EntityNotFoundException;
use GSVnet\Permissions\Permission;
use Illuminate\Support\Facades\Auth;

class ThreadRepository extends EloquentRepository
{
    public function __construct(Thread $model)
    {
        $this->model = $model;
    }

    public function getIdBySlug($slug)
    {
        return $this->model->where('slug', '=', $slug)->pluck('id');
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
            $query->with(['visitations' => function($q) use ($id){
                $q->where('user_id', $id);
            }]);
        }

        $query->orderBy('updated_at', 'desc');

        return $query->paginate($perPage, ['forum_threads.*']);
    }

    public function getThreadRepliesPaginated(Thread $thread, $perPage = 20)
    {
        $query = $thread->replies()->with('author');

        if( Auth::check() )
        {
            $id = Auth::user()->id;

            $query->with(['likes' => function($q) use ($id){
                $q->where('user_id', $id);
            }]);
        }

        $query->orderBy('created_at', 'asc');

        return $query->paginate($perPage);
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
            $query->withTrashed();
        }

        if ( Auth::check() )
        {
            $id = Auth::user()->id;
            $query->with(['likes' => function($q) use ($id)
            {
                $q->where('user_id', $id);
            }]);
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

    public function setTags(Thread $thread, $tags)
    {
        $thread->tags()->sync($tags);
    }

    public function incrementReplies($threadId)
    {
        $this->model->where('id', $threadId)->increment('reply_count');
    }
    public function decrementReplies($threadId)
    {
        $this->model->where('id', $threadId)->decrement('reply_count');
    }

    public function setLastReply($threadId, $replyId)
    {
        $this->model->where('id', $threadId)->update([
            'most_recent_reply_id' => $replyId
        ]);
    }

    public function resetLatestReplyFor(Thread $thread)
    {
        $last = $thread->replies()->orderBy('created_at', 'DESC')->first();

        if(!$last)
            $thread->most_recent_reply_id = null;
        else
            $thread->most_recent_reply_id = $last->id;

        $thread->save();
    }

    public function slugExists($slug)
    {
        return $this->model->where('slug', $slug)->exists();
    }

    public function like(Thread $thread, Like $like)
    {
        $thread->likes()->save($like);
    }

    public function incrementLikeCount($threadId)
    {
        $this->model->where('id', $threadId)->increment('like_count');
    }

    public function decrementLikeCount($threadId)
    {
        $this->model->where('id', $threadId)->decrement('like_count');
    }
}