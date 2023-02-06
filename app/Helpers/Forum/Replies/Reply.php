<?php namespace App\Helpers\Forum\Replies;

use App\Helpers\Users\User;
use App\Helpers\Forum\LikableTrait;
use App\Helpers\Forum\Threads\Thread;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Reply extends Model
{
    use PresentableTrait;
    use LikableTrait;
    
    protected $table = 'forum_replies';
    protected $fillable = ['body', 'author_id', 'thread_id'];
    protected $with = ['author'];
    protected $softDelete = true;

    public $presenter = ReplyPresenter::class;

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class, 'thread_id');
    }
}
