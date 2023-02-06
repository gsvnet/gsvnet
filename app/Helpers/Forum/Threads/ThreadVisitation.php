<?php namespace GSV\Helpers\Forum\Threads;

use GSV\Helpers\Core\Entity;

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
        return $this->belongsTo('GSV\Helpers\Users\User', 'user_id');
    }
}
