<?php namespace GSVnet\Forum\Replies;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Reply extends Model
{
    use PresentableTrait;
    
    protected $table = 'forum_replies';
    protected $fillable = ['body', 'author_id', 'thread_id'];
    protected $with = ['author'];
    protected $softDelete = true;

    public $presenter = 'GSVnet\Forum\Replies\ReplyPresenter';

    public function author()
    {
        return $this->belongsTo('GSVnet\Users\User', 'author_id');
    }

    public function thread()
    {
        return $this->belongsTo('GSVnet\Forum\Threads\Thread', 'thread_id');
    }

    public function isManageableBy($user)
    {
        if ( ! $user) return false;
        return $this->isOwnedBy($user) || $user->isForumAdmin();
    }

    public function isOwnedBy($user)
    {
        if ( ! $user) return false;
        return $user->id == $this->author_id;
    }
}
