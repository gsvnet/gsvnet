<?php namespace GSVnet\Forum\Threads;

use Carbon\Carbon;
use GSVnet\Users\UsersRepository;

class ThreadVisitationUpdater
{
    private $users;

    function __construct(UsersRepository $users)
    {
        $this->users = $users;
    }

    public function update($threadId, $userId)
    {
        $visitation = $this->getVisitation($threadId, $userId);

        if(Carbon::now()->subMinutes(5) > $visitation->visited_at) {
            $this->users->byId($userId)->getAprilFools()->visitThread();
            $visitation->visited_at = date('Y-m-d H:i:s');
        }
        $visitation->save();
    }

    public function getVisitation($threadId, $userId)
    {
    	return ThreadVisitation::firstOrNew([
    		'user_id' => $userId,
    		'thread_id' => $threadId
    	]);
    }
}
