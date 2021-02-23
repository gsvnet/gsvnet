<?php namespace GSVnet\Forum\Threads;

use DB, Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use GSVnet\Forum\Replies\ReplySearch;

class ThreadSearch
{
    protected $model;

    public function __construct(Thread $model)
    {
        $this->model = $model;
    }

    // this stuff is just a placeholder until we implement
    // a real search system
    public function searchPaginated($query, $perPage)
    {
        $id = Auth::check() ? Auth::user()->id : 0;
       

        $thread_ids = app(ReplySearch::class)->searchReplys($query);
        
        $query = $this->model->where(function($q) use ($query, $thread_ids) {
            $q->where('subject', 'like', '%' . $query . '%')
                ->orWhere('body', 'like', '%' . $query . '%')
                ->orWhereIn('id', $thread_ids);
            })
            ->orderBy('updated_at', 'desc')
            ->with(['mostRecentReply'])
            ->with(['visitations' => function($q) use ($id){
                $q->where('user_id', $id);
            }]);

        // Only show public threads when the user does not
        // have permission to see internal threads
        if (Gate::denies('threads.show-internal'))
        {
            $query = $query->public();
        }

        // Don't show private threads (even more private than internal)
        // if the user doesn't have permission to view them
        if (Gate::denies('threads.show-private'))
            $query = $query->where('private', '=', 0);

        return $query->paginate($perPage, ['forum_threads.*']);
    }
}