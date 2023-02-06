<?php namespace App\Helpers\Forum\Threads;

class ThreadVisitationUpdater
{
    public function update($threadId, $userId)
    {
        $visitation = $this->getVisitation($threadId, $userId);
        $visitation->visited_at = date('Y-m-d H:i:s');
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
