<?php namespace GSVnet\Forum\Threads;

use DB, Permission;
use Illuminate\Support\Facades\Auth;

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
        $id = Auth::user()->id;
        $query = $this->model->where(function($q) use ($query) {
            $q->where('subject', 'like', '%' . $query . '%')
                ->orWhere('body', 'like', '%' . $query . '%');
            })
            ->orderBy('updated_at', 'desc')
            ->with(['mostRecentReply'])
            ->with(['visitations' => function($q) use ($id){
                $q->where('user_id', $id);
            }]);

        // Only show public threads when the user does not
        // have permission to see private threads
        if (! Permission::has('threads.show-private'))
        {
            $query = $query->public();
        }

        return $query->paginate($perPage, ['forum_threads.*']);
    }
}