<?php namespace GSVnet\Forum\Threads;

use GSVnet\Users\User;

class ThreadVisitationUpdater
{
    public function update(Thread $thread, User $user)
    {
        $visitation = $this->getVisitation($thread, $user);
        $visitation->visited_at = date('Y-m-d H:i:s');
        $visitation->save();
    }

    public function getVisitation(Thread $thread, User $user)
    {
    	return ThreadVisitation::firstOrCreate([
    		'user_id' => $user->id,
    		'thread_id' => $thread->id
    	]);
    }
}
