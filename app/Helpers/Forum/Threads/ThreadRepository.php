<?php namespace GSV\Helpers\Forum\Threads;

use GSV\Helpers\Forum\Like;
use GSV\Helpers\Forum\Replies\Reply;
use GSV\Helpers\Permissions\Permission;
use Illuminate\Support\Collection;
use GSV\Helpers\Core\EloquentRepository;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use GSV\Helpers\Core\Exceptions\EntityNotFoundException;

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
                ->whereIn('tagged_items.tag_id', $tags->pluck('id'));
        }

        if ( Gate::denies('threads.show-internal'))
        {
            $query = $query->public();
        }

        if (Gate::denies('threads.show-private'))
            $query = $query->where('private', '=', 0);

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
        if (Gate::allows('thread.manage'))
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

        if ( Gate::denies('threads.show-internal'))
        {
            $query = $query->public();
        }

        if (Gate::denies('threads.show-private'))
            $query = $query->where('private', '=', 0);

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
        return $this->model::withTrashed()->where('slug', $slug)->exists();
    }

    public function like(Thread $thread, Like $like)
    {
        $thread->likes()->save($like);
    }

    public function incrementLikeCount($threadId)
    {
        //$this->model->where('id', $threadId)->increment('like_count');
        /* NOTE: The increment method above seems to update timestamps, which we don't want here */

        $thread = $this->model->where('id', $threadId)->first();
        
        $thread->timestamps = false;
        $thread->like_count++;
        $thread->save();
    }

    public function decrementLikeCount($threadId)
    {
        //$this->model->where('id', $threadId)->decrement('like_count');
        /* NOTE: The decrement method above seems to update timestamps, which we don't want here */

        $thread = $this->model->where('id', $threadId)->first();
        
        $thread->timestamps = false;
        $thread->like_count--;
        $thread->save();
    }

    public function totalLikesGivenPerYearGroup()
    {
        return Cache::remember('total-likes-given-per-year-group', 24*60, function()
        {
            return \DB::select("SELECT yg.name as name, count(1) AS likes_given
                FROM likeable_likes as ll
                INNER JOIN user_profiles as up
                ON ll.user_id = up.user_id
                INNER JOIN year_groups as yg
                ON yg.id = up.year_group_id
                GROUP BY yg.id
                HAVING likes_given > 30
                ORDER BY yg.year DESC"
            );
        });
    }

    public function totalLikesReceivedPerYearGroup()
    {
        return Cache::remember('total-likes-received-per-year-group', 24*60, function()
        {
            // This is getting quite a large query... LOL
            return \DB::select("SELECT t.name, count(t.id) AS likes_received
                FROM
                (
                    SELECT yg.id, yg.year, yg.name
                    FROM likeable_likes as ll
                    INNER JOIN forum_replies as fr
                    ON fr.id = ll.likable_id
                    INNER JOIN user_profiles as up
                    ON fr.author_id = up.user_id
                    INNER JOIN year_groups as yg
                    ON yg.id = up.year_group_id
                    WHERE ll.likable_type = ?

                    UNION ALL

                    SELECT yg.id, yg.year, yg.name
                    FROM likeable_likes as ll
                    INNER JOIN forum_threads as ft
                    ON ft.id = ll.likable_id
                    INNER JOIN user_profiles as up
                    ON ft.author_id = up.user_id
                    INNER JOIN year_groups as yg
                    ON yg.id = up.year_group_id
                    WHERE ll.likable_type = ?
                ) t
                GROUP BY t.id
                HAVING likes_received > 30
                ORDER BY t.year DESC",
                [
                    Reply::class,
                    Thread::class
                ]
            );
        });
    }
}
