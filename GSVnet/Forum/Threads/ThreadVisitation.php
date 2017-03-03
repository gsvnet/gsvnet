<?php namespace GSVnet\Forum\Threads;

use GSVnet\Core\Entity;

class ThreadVisitation extends Entity
{
    protected $table      = 'forum_thread_visitations';
    protected $fillable   = ['user_id', 'thread_id', 'visited_at'];

    protected $validationRules = [
        'user_id'   => 'required',
        'thread_id' => 'required',
        'visited_at' => 'required',
    ];

    public function user()
    {
        return $this->belongsTo('GSVnet\Users\User', 'user_id');
    }
}
